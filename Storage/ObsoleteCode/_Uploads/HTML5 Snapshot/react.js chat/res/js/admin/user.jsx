var UserList = React.createClass({
  render: function() {
    var user_list = this.props.userList.map(function (user) {
      return (
        <tr className={parseInt(user.isTokenAvaliable) === 1 ? 'online' : 'offline'}>
          <td>{user.uid}</td>
          <td className="fo">
            <img src={user.avatar} height="80" width="80" className="avatar" alt="用户头像"/>
            <br/>
          {user.nickname}
          </td>
          <td>{user.phone}</td>
          <td>{parseInt(user.sex) === 1 ? '♂' : '♀'}</td>
          <td>{parseInt(user.age)>0 ? user.age + '岁' : ''}</td>
          <td>{parseInt(user.height)>0 ? user.height + ' cm' : ''}</td>
          <td>{parseInt(user.weight)>0 ? user.weight + ' KG' : ''}</td>
          <td>{parseFloat(user.BMI)>0 ? user.BMI : ''}</td>
          <td>{user.isSmoker}</td>
          <td>{user.isDrinker}</td>
          <td>{new Date(parseInt(user.time) *1000).toLocaleString()}</td>
          <td>{user.token}</td>
          <td>{user.guid}</td>
        </tr>
      );
    });
    return (
      <table>
        <tr>
          <th>UID</th>
          <th></th>
          <th>手机号</th>
          <th>性别</th>
          <th>年龄</th>
          <th>身高</th>
          <th>体重</th>
          <th>BMI</th>
          <th>是否吸烟</th>
          <th>是否喝酒</th>
          <th>注册时间</th>
          <td>TOKEN</td>
          <th>GUID</th>
        </tr>
        {user_list}
      </table>
    )
  }
});
var UserFrame = React.createClass({
  getInitialState: function(){
    return {userList:[]}
  },
  loadUserList: function(){
    $.ajax({
      method:'GET',
      url: Conf.host + '/v0/index.php?c=User',
      dataType: 'json',
      headers:{
        'guid': navigator.userAgent,
        'token': localStorage['token']
      },
      success: function(res) {
        errhanle(res);
        var data = res.data;
        this.setState({userList: data});

      }.bind(this),
      error: function(xhr, status, err) {
        console.error(status, err.toString());
      }.bind(this)
    });
  },
  componentDidMount: function(){
    if(localStorage['uid'] && localStorage['token']){
      this.loadUserList();
      //setInterval(this.loadInquiryList, 30000);   // 轮询
    }
  },
  render: function(){
    return (
      <UserList userList={this.state.userList}/>
    )
  }
});
React.render(
  <UserFrame/>,
  document.getElementById('content')
);