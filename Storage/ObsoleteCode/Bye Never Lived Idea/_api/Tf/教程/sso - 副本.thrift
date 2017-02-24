namespace php Tf.Sso
namespace js Tf.Sso


/*
  Thrift允许用户定义常量，复杂的类型和结构体可使用JSON形式表示。
const i32 INT_CONST = 1234;    // a
const map<string,string> MAP_CONST = {"hello": "world", "goodnight": "moon"}
说明：
a．  分号是可选的，可有可无；支持十六进制赋值。
*/
const string SSO_SESS_ID = 'sessid'
const string SSO_SIGN_INFO  = 'siginfo'

/**api 调用失败 返回的 错误代码 */
enum ErrCodeEnum{
/**system or server maintenance*/
  ERR_SERVER = 1,
/**db not found or page not found*/
  ERR_NOT_FOUND = 2,
/**db value exits, cant create one more*/
  ERR_REPEATED = 3,
/**user send illegal words or something illegal  */
  ERR_USER_INPUT = 4,
/**temporary verification  */
  ERR_CAPTCHA = 5,
/**username or pwd error, or verify code error*/
  ERR_VERIFY = 6,
/**need login, or permissions neccesarry*/
  ERR_PERMISSION = 7,

}


/**异常*/
exception Err{      
/**错误code*/
  1: ErrCodeEnum code,  
/**错误消息*/
  2: string msg,    

}


/**账号类型*/
enum AccountTypeEnum{   
/**用户名*/
  USERNAME = 1,     
/**手机号*/
  PHONE = 2,        
/**邮箱*/
  EMAIL = 3,        

}


/**验证码消息 样式*/
enum VericodeStyleEnum{   
/**注册 验证码*/
    REG = 1,          
/**绑定 验证码*/
    BIND = 2,         

}


/**账号 */
struct AccountStruct{         
/**账号       */
  1:string val,         
/**账号 类型 */
  2:AccountTypeEnum type,   

}


/**登录数据*/
struct SignInfoStruct{          
/**用户名*/
  1:string username,      
/**email 含省略号*/
  2:string email,         
/**phone 含省略号*/
  3:string phone,         

}




/**登录*/
service SignAct{  
  
/**获取登录数据*/
  SignInfoStruct getSignInfo(       
/**会话id*/
    1:string targetSessId,    
  )throws (1:Err err)
  
/**登录*/
  SignInfoStruct signIn(      
/**账号*/
    1:AccountStruct account,  
/**密码*/
    2:string pwd,       
/**验证码*/
    3:string captcha,   
  )throws (1:Err err)

/**注销*/
  void signOut(   
  )throws (1:Err err)

}



/**个人设置*/
service SignSetting{  
  
/**检测账户 是否可被注册*/
  void isAccountValid(    
/**账户*/
    1:AccountStruct account,    
  )throws (1:Err err)

/**发送验证码到 绑定的邮箱上面*/
  void sendExistEmailVericode(  
  )throws (1:Err err)
  
/**发送验证码到 绑定的手机号上面*/
  void sendExistPhoneVericode(  
  )throws (1:Err err)
  
/**发送验证码 到邮箱  绑定货注册*/
  void sendEmailVericodeForBinding( 
/**邮箱账户    */
    1:string email,                 
/**消息样式*/
    2:VericodeStyleEnum style,          
  )throws (1:Err err)
  
/**发送验证码 到手机  绑定货注册*/
  void sendPhoneVericodeForBinding( 
/**手机号*/
    1:string phone,                 
/**消息样式*/
    2:VericodeStyleEnum style,          
  )throws (1:Err err)

/**验证*/
  void verify(           
/**收到的验证码*/
    1:string vericode,   
  )throws (1:Err err)
  
/**注册*/
  void regInitPwd(  
/**密码*/
    1:string pwd,   
  )throws (1:Err err)
  
/**重置密码*/
  void resetPwd(    
/**密码*/
    1:string pwd,   
  )throws (1:Err err)
  
/**初始化用户名   只能设置1次*/
  void initUsername(    
/**用户名*/
    1:string username,  
  )throws (1:Err err)
  
/**绑定*/
  void bind(  
  )throws (1:Err err) 

/**取消绑定*/
  void unbind( 
  )throws (1:Err err)

}