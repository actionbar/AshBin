// include "c.thrift"

namespace php Tf.Sso
namespace js Tf.Sso



const map<string,string> SSO_COOKIE_NAME = {
    'sessId':'sso_sess_id',
    'signInfo':'sso_sign_info'
}


/**
 * Error Id Enum
 */
enum ErrIdEnum {
    //SUCCESS = 0,
    // unknown error
    ERR_UNKNOWN = 1,
// system or server maintenance
    ERR_SERVER = 2,

// db not exists or page not found
    ERR_NOT_EXISTS = 3,
// db value exits, cant create one more
    ERR_REPEATED = 4,
// user send illegal words or something illegal
    ERR_USER_INPUT = 5,
// temporary verification
    ERR_CAPTCHA = 6,
// username or pwd error, or verify code error
    ERR_VERIFY = 7,
// need login, or permissions neccesarry
    ERR_PERMISSION = 8
}


exception Err {
  // 
    1: ErrIdEnum id,
    2: string msg
}


enum AccountTypeEnum {
    USERNAME = 1,
    PHONE = 2,
    EMAIL = 3
}





struct SignInSt{
      // account value, e.g. 云上旭
    1: required string account,
  // account type, e.g. 1
    2: optional AccountTypeEnum account_type,
    3: required string pwd,
    4: optional string captcha
}


struct SignInfoSt {
  // username
    1: optional string username,
  // Security Email, e.g. a***@a.com
    2: optional string email,
   // Security Phone, e.g. 15*****3
    3: optional string phone
}

// SSO = single sign on

service Sign {
    SignInfoSt signIn(1:SignInSt sign_in_st) throws (1:Err err),

    //SignInfoSt signInfo(1:string target_sessid) throws (1:Err err),
    
       /**
    * This method has a oneway modifier. That means the client only makes
    * a request and does not listen for any response at all. Oneway methods
    * must be void.
    * client发出请求后不必等待回复（非阻塞）直接进行下面的操作
    */
    //oneway void autoSignIn(),

    // 任何平台下获取sso session id 都是通过 .luexu.com 的cookie！！ 
    oneway void signOut(),

    /**
     * check if the account (username/Email/Phone) avaliable 
     * which means the account is not repetaed in Db
     * exception is a kinda return
     * so use isAccountValid() istead of checkAccount()
     */
    void isAccountValid(
        1:required string account,
        2:AccountTypeEnum account_type
        ) throws (1:Err err),

    void sendVericodeForSignUp(
        // email / phone
        1:required string account
        2:AccountTypeEnum account_type
    ) throws (1:Err err),

    void sendVericode(
        // email/phone is optional
        1:string account,
        2:required AccountTypeEnum account_type
    ) throws (1:Err err),



  // send the vericode to Email that existed in Db (not by inputed)
  
    void verify(1:string vericode) throws (1:Err err),

  // init password after finish the reg verify (Email or Phone)
    void initPwd(1:string pwd) throws (1:Err err),
   
// bind username / email / phone
    void bind(
        1:required string account,
        2:AccountTypeEnum account_type) throws (1:Err err),
    // unbind phone must verify email, vice versa
    void unbind(
        1:required string account,
        2:AccountTypeEnum account_type) throws (1:Err err)
}