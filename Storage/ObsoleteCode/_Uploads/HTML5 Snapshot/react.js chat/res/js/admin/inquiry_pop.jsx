var isDragingInquiryPop=false;
var inquiryPopX,inquiryPopY;

$(document).mousemove(function(e){
  if(isDragingInquiryPop){
    var x= e.pageX - inquiryPopX;
    var y= e.pageY - inquiryPopY;
    $("#inquiry_pop_frame").css({top:y,left:x});
  }
}).mouseup(function(){
  if(isDragingInquiryPop){
    isDragingInquiryPop=false;
    $("#inquiry_pop_frame").fadeTo("fast", 1);
  }
});


var InquiryPop = React.createClass({
  getInitialState: function(){
    return {talkData:[], talkTo:{}, page:0, inquiryList:[], currentInquiryId: this.props.inquiryId}
  },
  loadInquiryList: function(){
    $.ajax({
      method:'GET',
      url: Conf.host + '/v0/index.php?c=Inquiry&a=listMyInquiry',
      dataType: 'json',
      headers:{
        'guid': navigator.userAgent,
        'token': localStorage['token']
      },
      data:{
        page: this.state.page
      },
      success: function(res) {
        errhanle(res);

        if(null != res.data){
          this.setState({inquiryList:res.data});
        }else {
          alert('哦哦，没有了，请返回上一页');
          $('.inquiry-list-page-ctrl-next').hide(300);
          this.state.page--;
        }

      }.bind(this),
      error: function(xhr, status, err) {
        console.error(status, err.toString());
      }.bind(this)
    });
  },

  changeInquiryId: function(inquiry_id){
    this.setState({currentInquiryId:inquiry_id});
    this.state.currentInquiryId = inquiry_id;
    this.getTalkData();
  },


  componentDidMount: function(){
    if(localStorage['uid'] && localStorage['token']){
      this.loadInquiryList();
      setInterval(this.loadInquiryList, 30000);   // 轮询

      this.getTalkData();
      setInterval(this.getTalkData, 30000);   // 轮询
    }
  },

  dragHandle: function(e){
    isDragingInquiryPop = true;
    inquiryPopX = e.pageX - parseInt($("#inquiry_pop_frame").css("left"));
    inquiryPopY = e.pageY - parseInt($("#inquiry_pop_frame").css("top"));
    $("#inquiry_pop_frame").fadeTo(20, 0.5);
  },



  getTalkData: function(){
    $.ajax({
      method:'GET',
      url: '/v0/?c=Talk&timeOffset=0&inquiryId=' + this.state.currentInquiryId,
      dataType: 'json',
      headers:{
        'guid': navigator.userAgent,
        'token': localStorage['token']
      },
      success: function(res) {
        var scroll_top = $('.inquiry-instance-msg').scrollTop();
        scroll_top += 10000;
        $('.inquiry-instance-msg').animate({scrollTop: scroll_top}, 300);

        if(res.errmsg.length > 1)
          alert(res.errmsg);
        else{
          var data = res.data,
            a_talk = data[0],
            talk_to;
          if(a_talk.inquirerUid == localStorage['uid']){
            talk_to = {
              nickname: a_talk.talkTo,
              doctorId: a_talk.talkToDoctorId,
              uid:  a_talk.talkToUid,
              guid: a_talk.talkToGuid,
              inquiryId: this.state.currentInquiryId
            };
          } else if(a_talk.talkToUid == localStorage['uid']){
            talk_to = {
              nickname: a_talk.inquirer,
              doctorId: a_talk.talkToDoctorId,
              uid:  a_talk.inquirerUid,
              guid: a_talk.inquirerGuid,
              inquiryId: this.state.currentInquiryId
            };
          } else {
            alert('你没有参与该问诊');
            return ;
          }

          console.log(talk_to);
          this.setState({
            talkData: data,
            talkTo: talk_to
          });
        }

      }.bind(this),
      error: function(xhr, status, err) {
        console.error(this.props.url, status, err.toString());
      }.bind(this)
    });
  },
  render: function(){
    return (
      <div className="o" id="inquiry_pop">
        <InquiryPopSubLeft dragHandle={this.dragHandle} />
        <InquiryPopList currentInquiryId={this.state.currentInquiryId} inquiryList={this.state.inquiryList} changeInquiryId={this.changeInquiryId}/>

        <div className="p inquiry-pop-c">
          <div className="inquiry-pop-c-head" onMouseDown={this.dragHandle}>
            <h1>{this.state.talkTo.nickname}</h1>
            <p className="f-gray">直接按键盘Enter键，就可以发送；您的登陆状态会在5分钟内显示给APP</p>
          </div>

          <InquiryInstanceMsg talkData={this.state.talkData}/>


          <InquiryPopForm refreshTalkData={this.getTalkData} talkTo={this.state.talkTo}/>

        </div>
      </div>
    );
  }
});



var InquiryPopSubLeft = React.createClass({
  getInitialState: function(){
    return {forceOnlineAvaliable: true}
  },
  statusTipHandle: function(e){
    if(this.state.forceOnlineAvaliable)
      $(e.target).removeClass().addClass('status-pending');
  },
  statusMouseOutHandle: function(e){
    if(this.state.forceOnlineAvaliable)
      $(e.target).removeClass().addClass('status-' + $(e.target).data('status'));
  },
  statusClickHandle: function(e){
    e.stopPropagation();
    e.preventDefault();
    if(this.state.forceOnlineAvaliable){
      this.state.forceOnlineAvaliable = false;
      $(e.target).removeClass().addClass('status-force-online');
      $(e.target).attr('title', '您已强制更新过在线状态');
    }
  },
  closeInquiryPop:function(e){
    isDragingInquiryPop = false;
    e.stopPropagation();
    $('#inquiry_pop_frame').hide(500);
  },
  render: function(){
    var avatar = localStorage['avatar'];
    return (
      <div className="p inquiry-pop-sub-left" onMouseDown={this.props.dragHandle}>
        <div className="a">
          <a href="javascript:void(0)" onClick={this.closeInquiryPop} className="inquiry-pop-zoom inquiry-pop-close">x</a>
          <a href="javascript:void(0)" onClick={this.closeInquiryPop} className="inquiry-pop-zoom inquiry-pop-zoom-out">-</a>
          <a href="javascript:void(0)" onClick={this.closeInquiryPop} className="inquiry-pop-zoom inquiry-pop-zoom-in">+</a>
        </div>
        <div>
          <img src={avatar} className="inquiry-pop-avatar" />
        </div>
        <div className="inquiry-pop-avatar-status" title="登陆状态每5分钟更新一次，您可以点击这里立即更新状态">
          <i onClick={this.statusClickHandle} onMouseOver={this.statusTipHandle} onMouseOut={this.statusMouseOutHandle} data-status="waiting" className="status-waiting"></i>
        </div>
      </div>
    )
  }
});

var InquiryPopList = React.createClass({
  mouseDownHandle:function(e){
    $('.inquiry-pop-list li').removeClass('inquiry-pop-list-li-hover');

    $(e.target).parents('li').addClass('inquiry-pop-list-li-hover');
  },
  render: function(){
    var inquiry_list = this.props.inquiryList.map(function(inquiry){
      var url = '/m-y-admin/inquiry_list?inquiryId=' + inquiry.inquiryId;
      var is_doctor = inquiry.doctorId;

      if(inquiry.inquirerUid == localStorage['uid']){
        talk_to = inquiry.talkTo;
        talk_to_uid = inquiry.talkToUid;
        talk_to_guid = inquiry.talkToGuid;
        status_dom = '';
      } else {
        talk_to = inquiry.inquirer;
        talk_to_uid = inquiry.inquirerUid;
        talk_to_guid = inquiry.inquirerGuid;
        status_dom =  <a className="inquiry-pop-list-msg-notification" href="javascript:void(0);">1</a>;
      }
      var li_class_name = 'a o ';
      li_class_name += inquiry.inquiryId == this.props.currentInquiryId ? ' inquiry-pop-list-li-hover ' : '';
      return (
      <li className={li_class_name}
        onMouseDown={this.mouseDownHandle}
        onClick={this.props.changeInquiryId.bind(this, inquiry.inquiryId)} data-inquiry-id={inquiry.inquiryId}>
        <a href="javascript:void(0);">
          <img src={inquiry.talkToAvatar} className="inquiry-pop-list-avatar" />
        </a>
        <a href="javascript:void(0);" className="inquiry-pop-list-nickname">
          {talk_to}
        </a>
        {status_dom}
      </li>
      );
    }, this);

    return (
      <div className="p inquiry-pop-list">
        <ul>
          {inquiry_list}
        </ul>
      </div>
    )
  }
});






var InquiryInstanceMsgPics = React.createClass({
  zoomIn: function(e){
    window.open($(e.target).attr('src'));
  },
  render: function(){
    var parent = this;
    if(!this.props.imgs)
      return (
        <span></span>
      );
    var imgs = this.props.imgs.map(function(img){
      var o_width = img.width, o_height = img.height;
      ResizeImg.setRange(380);
      var wh = ResizeImg.resize(o_width,o_height);
      return (
        <img onClick={parent.zoomIn} src={img.imgUrl} width={wh.width} height={wh.height} alt="聊天图片"/>
      );
    });
    return (
      <div>{imgs}</div>
    );
  }
});

var InquiryInstanceMsgText = React.createClass({
  render: function(){
    return (
      <p>{this.props.content}</p>
    );
  }
});


var InquiryInstanceMsg = React.createClass({
  render: function(){
    var talk_data = this.props.talkData.map(function(dt){
      var talk_content = dt.content ? <InquiryInstanceMsgText content={decodeURI(dt.content)}/> :'';
      var talk_imgs = dt.caseImgs ? <InquiryInstanceMsgPics imgs={dt.caseImgs} /> : '';

      if(dt.inquirerUid != localStorage['uid']){
        return (
          <div className="p o inquiry-instance-msg-inquiry">
            <img src={dt.avatar} className="p inquiry-instance-msg-avatar"/>
            <div className="p">
              <div className="inquiry-instance-msg-content-box">
                <div className="inquiry-instance-msg-content-arrow"></div>
                <div className="inquiry-instance-msg-content">
                  {talk_content}
                  {talk_imgs}
                </div>
              </div>
            </div>
          </div>
        );
      } else {
        return (
          <div className="q o inquiry-instance-msg-reply">
            <div className="q">
              <img src={dt.avatar} className="p inquiry-instance-msg-avatar"/>
            </div>

            <div className="q inquiry-instance-msg-reply-content-box">

              <div className="inquiry-instance-msg-reply-content">
                  {talk_content}
                  {talk_imgs}
              </div>
              <div className="inquiry-instance-msg-reply-content-arrow"></div>
            </div>

          </div>
        );
      }

    });
    return(
      <div className="inquiry-instance-msg">
        <div className="fo inquiry-instance-msg-time">
          Friday 23:11
        </div>
        <div className="o">
          {talk_data}
        </div>
      </div>
    );

  }
});


var InquiryPopForm = React.createClass({
  getInitialState: function(){
    return {inquiryInfo:{}};
  },
  componentDidMount: function(){

  },
  handleSubmit: function(e){
    if(13 != e.keyCode)      // Enter
      return ;

    var content = $(e.target).val();
    content = content.replace(/(^\s+)|(\s+$)/, '');
    var c_len = content.length;
    if(c_len < 1){
      alert('内容不能为空');
      return false;
    }

    var matches = content.match(/([\uD83C\uD83D][\uDC00-\uFFFF])/g);
    if(null != matches){
      for(var i=0;i< matches.length; ++i){
        content = content.replace(matches[i], encodeURI(matches[i]));
      }
    }

    $.ajax({
      method:'POST',
      url: Conf.host + '/v0/Talk',
      dataType: 'json',
      headers:{
        guid: navigator.userAgent,
        token: localStorage['token']
      },
      data:{
        content: content,
        isImg:0,
        talkToUid: this.props.talkTo.uid,
        talkTo: this.props.talkTo.nickname,
        talkToGuid: this.props.talkTo.guid,
        doctorId: this.props.talkTo.doctorId,
        inquiryId: this.props.talkTo.inquiryId
      },
      success: function(data) {
        this.props.refreshTalkData();
        $('.inquiry-msg').val('');
        var scroll_top = $('.inquiry-instance-msg').scrollTop();
        scroll_top += 10000;
        $('.inquiry-instance-msg').animate({scrollTop: scroll_top}, 300);

        if(data.errmsg.length > 1)
          alert(data.errmsg);
        else
          this.setState({talkData: data.data});
      }.bind(this),
      error: function(xhr, status, err) {
        console.error(this.props.url, status, err.toString());
      }.bind(this)
    });
    return;
  },
  imgUploadHandle: function(e){
    var parent_ = this;
    $(e.target).ajaxfileupload({
      action: Conf.host +  '/v0/Talk',
      params:{
        guid: navigator.userAgent,
        token: localStorage['token'],
        content: '',
        isImg:1,
        talkToUid: this.props.talkTo.uid,
        talkTo: this.props.talkTo.nickname,
        talkToGuid: this.props.talkTo.guid,
        doctorId: this.props.talkTo.doctorId,
        inquiryId: this.props.talkTo.inquiryId
      },
      'onComplete': function(res) {
        parent_.props.refreshTalkData();
        var scroll_top = $('.inquiry-instance-msg').scrollTop();
        scroll_top += 10000;
        $('.inquiry-instance-msg').animate({scrollTop: scroll_top}, 300);

        if(res.errmsg.length > 1)
          alert(res.errmsg);
        else
          parent_.setState({talkData: res.data});
      },
      'onStart': function() {
      },
      'onCancel': function() {
        console.log('no file selected');
      }
    });
  },
  render: function(){
    return (
      <div className="inquiry-form-box">
        <form className="inquiry-form">
          <div className="a o inquiry-pop-icons">
            <a href="javascript:void(0)" className="po inquiry-pop-icons-img">
              <input type="file" name="imgFiles[]" onMouseDown={this.imgUploadHandle} className="inquiry-pop-icons-img-upload" value=""/>
            </a>
          </div>
          <textarea className="inquiry-msg" ref="inquiryMsg" onKeyDown={this.handleSubmit}></textarea>
        </form>
      </div>
    );
  }
});