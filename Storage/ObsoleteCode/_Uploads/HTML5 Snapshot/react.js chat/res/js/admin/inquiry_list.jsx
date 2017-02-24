var InquiryCaseImgs = React.createClass({
  zoomIn: function(e){
    window.open($(e.target).attr('src'));
  },
  loadImgErrorHandle: function(e){
    $(e.targe).attr('src', "/res/img/avatar/lef_well.png");
  },
  render: function(){
    if(!this.props.caseImgs)
    return (
      <span></span>
    );
    else
    var parent = this;
    var imgs = this.props.caseImgs.map(function(img){
        return (
          <img onClick={parent.zoomIn} src={img.imgUrl} onError={this.loadImgErrorHandle} width="50" height="50"/>
        );
    }, this);
    return (
      <div>
        {imgs}
      </div>
    );
  }
});
var InquiryList = React.createClass({
  render: function(){
    var inquiry_list = this.props.inquiryList.map(function(inquiry){
      var url = '/m-y-admin/inquiry_list?inquiryId=' + inquiry.inquiryId;
      var is_doctor = inquiry.doctorId;

      if(inquiry.inquirerUid == localStorage['uid']){
        talk_to = inquiry.talkTo;
        talk_to_uid = inquiry.talkToUid;
        talk_to_guid = inquiry.talkToGuid;
        status_tip = '已回复';
        status_class = 'replied';

      } else {
        talk_to = inquiry.inquirer;
        talk_to_uid = inquiry.inquirerUid;
        talk_to_guid = inquiry.inquirerGuid;
        status_tip= '待查看';
        status_class = 'wait-for-replying';
      }
      return (
        <tr>
          <td>{inquiry.talkId}</td>
          <td>{inquiry.inquiryId}</td>
          <td>{talk_to_uid}</td>
          <td className="fo">
            <img className="avatar" src={inquiry.talkToAvatar} width="30" height="30" alt={talk_to.asker}/>
            <br/>
            {talk_to}
          </td>
          <td>
            {decodeURI(inquiry.content)}
            <br/>
            <InquiryCaseImgs caseImgs={inquiry.caseImgs}/>
          </td>
          <td>
           {new Date(parseInt(inquiry.time) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ')}
          </td>
          <td>
            <a href={url} className={status_class}>
              {status_tip}
            </a>
          </td>
        </tr>
      );
    }, this);
    return (
        <tbody>
          {inquiry_list}
        </tbody>
    );
  }
});
var InquiryFrame = React.createClass({
  getInitialState: function(){
    return {page:0, inquiryList:[]}
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
  previousPage: function(){
    if(this.state.page > 0){
      this.state.page--;
      this.loadInquiryList();
    } else {
      $('.inquiry-list-page-ctrl-prev').hide(300);
    }
    $('.inquiry-list-page-ctrl-next').show(300);
  },
  nextPage:function(){
    this.state.page++;
    this.loadInquiryList();

    if(this.state.page > 0)
      $('.inquiry-list-page-ctrl-prev').show(300);
    else
      $('.inquiry-list-page-ctrl-prev').hide(300);
  },
  componentDidMount: function(){
    if(localStorage['uid'] && localStorage['token']){
      this.loadInquiryList();
      setInterval(this.loadInquiryList, 30000);   // 轮询
    }
  },
  render: function(){
    return (
    <table className="inquiry-list-table">
      <thead>
        <tr>
          <th>会话ID</th>
          <th>问诊ID</th>
          <th>用户ID</th>
          <th></th>
          <th className="inquiry-list-content">问诊内容</th>
          <th>更新时间</th>
          <th>操作</th>
        </tr>
      </thead>
        <InquiryList inquiryList={this.state.inquiryList}/>
      <tfoot>
        <tr>
          <td colSpan="9" className="fo">
            <a href="javascript:void(0)" className="inquiry-list-page-ctrl inquiry-list-page-ctrl-prev" onClick={this.previousPage}>&lt;&lt; 上一页</a>
            <a href="javascript:void(0)" className="inquiry-list-page-ctrl inquiry-list-page-ctrl-next" onClick={this.nextPage}>下一页 &gt;&gt;</a>
          </td>
        </tr>
      </tfoot>
    </table>
    );
  }
});

React.render(
  <InquiryFrame/>,
  document.getElementById('content')
);