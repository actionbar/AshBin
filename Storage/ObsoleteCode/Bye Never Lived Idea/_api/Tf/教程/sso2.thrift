namespace php Tf.Sso
namespace js Tf.Sso

const string VERSION = '1.0.0'
const string SESS_ID = 'sessid'
const string SIGN_INFO  = 'siginfo'

enum ErrCode{           //api 调用失败 返回的 错误代码 
  ERR_SERVER = 1,       //system or server maintenance
  ERR_NOT_FOUND = 2,    //db not found or page not found
  ERR_REPEATED = 3,     //db value exits, cant create one more
  ERR_USER_INPUT = 4,   //user send illegal words or something illegal  
  ERR_CAPTCHA = 5,      //temporary verification  
  ERR_VERIFY = 6,       //username or pwd error, or verify code error
  ERR_PERMISSION = 7,   //need login, or permissions neccesarry

}

exception Err{              //异常
  1:required ErrCode code,  //错误code
  2:optional string msg,    //错误消息

}

enum AccountType{   //账号类型
  USERNAME = 1,     //用户名
  PHONE = 2,        //手机号
  EMAIL = 3,        //邮箱

}

enum VericodeStyle{   //验证码消息 样式
    REG = 1,          //注册 验证码
    BIND = 2,         //绑定 验证码

}

struct Account{                  //账号 
  1:required string val,         //账号       
  2:required AccountType type,   //账号 类型 

}


struct SignInfo{                   //登录数据
  1:optional string username,      //用户名
  2:optional string email,         //email 含省略号
  3:optional string phone,         //phone 含省略号

}

service SignAct{  //登录
  
  SignInfo getSignInfo(       //获取登录数据
    1:string targetSessId,    //会话id
  )
  
  SignInfo signIn(      //登录
    1:Account account,  //账号
    2:string pwd,       //密码
    3:string captcha,   //验证码
  )

  void signOut(   //注销
  )

}



service SignSetting{  //个人设置
  
  void isAccountValid(    //检测账户 是否可被注册
    1:Account account,    //账户
  )

  void sendExistEmailVericode(  //发送验证码到 绑定的邮箱上面
  )
  
  void sendExistPhoneVericode(  //发送验证码到 绑定的手机号上面
  )
  
  void sendEmailVericodeForBinding( //发送验证码 到邮箱  绑定货注册
    1:string email,                 //邮箱账户    
    2:VericodeStyle style,          //消息样式
  )
  
  void sendPhoneVericodeForBinding( //发送验证码 到手机  绑定货注册
    1:string phone,                 //手机号
    2:VericodeStyle style,          //消息样式
  )

  void verify(           //验证
    1:string vericode,   //收到的验证码
  )
  
  void regInitPwd(  //注册
    1:string pwd,   //密码
  )
  
  void resetPwd(    //重置密码
    1:string pwd,   //密码
  )
  
  void initUsername(    //初始化用户名   只能设置1次
    1:string username,  //用户名
  )
  
  void bind(  //绑定
  ) 

  void unbind( //取消绑定
  )

}
