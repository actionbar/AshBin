/*

aidChangeHandle: function(e){
  e.target.value  = e.target.value.replace(/[^\d]/g, '');
  if(0 == e.target.value || e.target.value.length == 0){
    $(e.target).parents('tr').find('.homescroll-input-url').show(500);
    $(e.target).parents('tr').find('.homescroll-input-file').show(500);
  } else{
    $(e.target).parents('tr').find('.homescroll-input-url').val('');
    $(e.target).parents('tr').find('.homescroll-input-url').hide(500);
    $(e.target).parents('tr').find('.homescroll-input-file').hide(500);
  }
},
urlChangeHandle: function(e){
  e.target.value  = e.target.value.replace(/\s/g, '');
  if(e.target.value.length == 0){
    $(e.target).parents('tr').find('.homescroll-input-aid').show(500);
  } else{
    $(e.target).parents('tr').find('.homescroll-input-aid').val('');
    $(e.target).parents('tr').find('.homescroll-input-aid').hide(500);
  }
},*/

var ScrollList = React.createClass({
  getInitialState: function(){
    return {imgDom:null};
  },
  radioChange: function(e){

  },
  componentDidMount: function(){
    var this_ = this;
    $('.homescroll-input-file').on('change', function(){
      if($(this).val().length > 0){
        $(this).parents('tr').find('.homescroll-input-aid').hide(500);
      }
      this_.setState({imgDom:$(this).parents('td').find('.imgOuter')});
    });
    $('.homescroll-input-file').ajaxfileupload({
      'action': Conf.host + '/v0/Promotion/homescrollImgUpload',
      'params':{
        'guid':'1000'
      },
      'onComplete': function(res) {
        console.log(res.errmsg);
        errhanle(res);
        $(this_.state.imgDom).html('<img src="'+ res.data.homescrollImgUrl +'" width="200" height="100">');
        console.log(JSON.stringify(res));

      },
      'onStart': function() {

      },
      'onCancel': function() {
        console.log('no file selected');
      }
    });
  },
  zoomIn: function(e){
    window.open($(e.target).attr('src'));
  },
  render: function(){
    var parent = this;
    var one = this.props.scrollList.map(function(item){
        return (
          <tr>
            <td><input type="checkbox" defaultChecked="checked"/></td>
            <td>{item.prid}</td>
            <td><input type="text" className="homescroll-input-aid" value={item.aid}/></td>
            <td><input type="text" className="homescroll-input-url" value={item.url} /></td>
            <td>
              <input type="file" name="homescrollImgFile" className="homescroll-input-file"/>
              <input type="hidden" name="uploadedImgUrl" value={item.imgurl}/>
              <input type="hidden" name="imgwidth" value={item.imgwidth}/>
              <input type="hidden" name="imgheight" value={item.imgheight}/>
              <br/>
              <div className="imgOuter">
                <img onClick={parent.zoomIn} src={item.imgurl} width="200" height="100" alt="图片"/>
              </div>
            </td>
            <td><input type="button" value="修改"/></td>
          </tr>
        );
    }, this);
    return (
      <tbody>
        <tr>
          <td><input type="checkbox" defaultChecked="checked"/></td>
          <td></td>
          <td><input type="text" className="homescroll-input-aid" /></td>
          <td><input type="text" className="homescroll-input-url" /></td>
          <td>
            <input type="file" name="homescrollImgFile" className="homescroll-input-file"/>
            <br/>
            <div className="imgOuter"></div>
          </td>
          <td><input type="button" value="添加"/></td>
        </tr>
        {one}
      </tbody>
    );
  }
});
var Homescroll = React.createClass({
  getInitialState: function(){
    return {page:0, scrollList:[]};
  },
  loadScrollList: function(){
    this.scrollList = [];

    $.ajax({
      method: 'GET',
      url: Conf.host +'/v0/Promotion/homeScroll',
      contentTypes: 'application/json',
      dataType: 'json',
      headers:{
        'guid': navigator.userAgent,
        'token': localStorage['token']
      },
      data:{
        page:0
      },
      success: function(res) {
        console.log(res.data);
        if(null != res.data){
          this.setState({scrollList:res.data});
        }
      }.bind(this),
      error: function(xhr, status, err) {
        console.error(status, err.toString());
      }.bind(this)
    });
  },
  componentDidMount: function(){
    this.loadScrollList();
    //setInterval(this.loadArticleList, 30000);   // 轮询
  },
  render: function(){
    return (
      <div>
        <table>
          <thead>
            <tr>
              <th>显示</th>
              <th>prid</th>
              <th>文章id</th>
              <th>链接</th>
              <th></th>
              <th>操作</th>
            </tr>
          </thead>

          <ScrollList scrollList={this.state.scrollList}/>
        </table>
      </div>
    );
  }
});

React.render(
  <Homescroll  />,
  document.getElementById('content')
);