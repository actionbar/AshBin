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
      ResizeImg.setRange(100);
      var wh = ResizeImg.resize(50,50);
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
          <div className="mg p o inquiry-instance-msg-inquiry">
            <img src={dt.avatar} className="p inquiry-instance-msg-avatar"/>
            <div className="p">
              <div className="inquiry-instance-msg-inquiry-title">{dt.inquirer}</div>
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
          <div className="mg q o inquiry-instance-msg-reply">
            <div className="inquiry-instance-msg-reply-content-box">
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
      <div className="p inquiry-instance-msg">
        {talk_data}
      </div>
    );

  }
});

var InquiryInstanceMsgList = React.createClass({
  render: function(){
    return (
      <div className="q"></div>
    );
  }
});

var InquiryInstanceMsgBox = React.createClass({
  render: function(){
    return (
      <div className="o">
        <InquiryInstanceMsg talkData={this.props.talkData}/>
        <InquiryInstanceMsgList/>
      </div>
    );
  }
});





var InquiryForm = React.createClass({


  getInitialState: function(){
    return {inquiryInfo:{}};
  },
  componentDidMount: function(){

  },
  handleSubmit: function(e){
    e.preventDefault();
    var content = $(e.target).find('.inquiry-msg').val();
    content = content.replace(/(^\s+)|(\s+$)/, '');
    if(content.length < 1){
      alert('内容不能为空');
      return false;
    }
    $.ajax({
      method:'POST',
      url: Conf.host + '/v0/Talk',
      dataType: 'json',
      headers:{
        'guid': navigator.userAgent,
        'token': localStorage['token']
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
        console.log(this.props.talkTo);
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
  render: function(){
    return (
      <div className="inquiry-form-box">
        <form className="inquiry-form" onSubmit={this.handleSubmit}>
          <textarea className="inquiry-msg" ref="inquiryMsg"></textarea>
          <input type="submit" className="inquiry-submit" value="提交"/>
        </form>
      </div>
    );
  }
});

var InquiryFrame = React.createClass({
  getInitialState: function(){
    return {talkData:[], talkTo:{}};
  },
  getTalkData: function(){
    $.ajax({
      method:'GET',
      url: '/v0/?c=Talk&timeOffset=0&inquiryId=' + this.props.inquiryId,
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
              inquiryId: this.props.inquiryId
            };
          } else if(a_talk.talkToUid == localStorage['uid']){
            talk_to = {
              nickname: a_talk.inquirer,
              doctorId: a_talk.talkToDoctorId,
              uid:  a_talk.inquirerUid,
              guid: a_talk.inquirerGuid,
              inquiryId: this.props.inquiryId
            };
          } else {
            alert('你没有参与该问诊');
            return ;
          }

          // console.log(talk_to);
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
  afterFormSubmited: function(ref_data){
    // TODO: submit to the server and refresh the list
  },
  componentDidMount: function(){
    if(localStorage['uid'] && localStorage['token']){
      this.getTalkData();
      setInterval(this.getTalkData, 30000);   // 轮询
    }
  },
  render: function(){
    return (
      <div className="inquiry-frame">
        <InquiryInstanceMsgBox talkData={this.state.talkData}/>
        <InquiryForm refreshTalkData={this.getTalkData} talkTo={this.state.talkTo} />
      </div>
    );
  }
});
