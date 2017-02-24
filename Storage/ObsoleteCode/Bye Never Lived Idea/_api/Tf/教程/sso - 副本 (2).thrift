// include "c.thrift"

namespace php Tf.Sso
namespace js Tf.Sso

// use '  instead of ""

const map<string,string> SSO_COOKIE_NAME = {
    'sessId':'sso_sess_id',
    'signInfo':'sso_sign_info'
}


struct CoordStruct {
    1: required double lat,
    2: required double lon
}


/**
 * Error Code Enum
 */
enum ErrCodeEnum {
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
    1: ErrCodeEnum code,
    2: string msg
}



enum VericodeStyleEnum {
  // send vericode for reg
    REG = 1,
  // send vericode for binding
    BIND = 2
}

enum AccountTypeEnum {
    USERNAME = 1,
    PHONE = 2,
    EMAIL = 3
}




struct AccountStruct {
  // account value, e.g. 云上旭
    1: required string val,
  // account type, e.g. 1
    2: optional AccountTypeEnum type
}


struct SignInfoStruct {
  // username
    1: optional string username,
  // Security Email, e.g. a***@a.com
    2: optional string email,
   // Security Phone, e.g. 15*****3
    3: optional string phone
}

service SignAct {
    SignInfoStruct signIn(
        1:AccountStruct account_struct,
        2:string pwd,
        3:string captcha
    ) throws (1:Err err),

    SignInfoStruct signInfo(1:string targetSessId) throws (1:Err err),
    
       /**
    * This method has a oneway modifier. That means the client only makes
    * a request and does not listen for any response at all. Oneway methods
    * must be void.
    * client发出请求后不必等待回复（非阻塞）直接进行下面的操作
    */
    oneway void autoSignIn(),
    oneway void signOut()
}


service SignSetting {
    /**
     * check if the account (username/Email/Phone) avaliable 
     * which means the account is not repetaed in Db
     * exception is a kinda return
     * so use isAccountValid() istead of checkAccount()
     */
    void isAccountValid(1:AccountStruct account_struct) throws (1:Err err),
    void sendEmailVericodeForBinding(
        1:string email,
        2:VericodeStyleEnum style,
    ) throws (1:Err err),

    void sendPhoneVericodeForBinding(
        1:string phone,
        2:VericodeStyleEnum style
    ) throws (1:Err err),


  // send the vericode to Email that existed in Db (not by inputed)
    void sendExistEmailVericode() throws (1:Err err),
    void sendExistPhoneVericode() throws (1:Err err),
    void verify(1:string vericode) throws (1:Err err),

  // init password after finish the reg verify (Email or Phone)
    void regInitPwd(1:string pwd) throws (1:Err err),
    void resetPwd(1:string pwd) throws (1:Err err),
    void initUsername(1:string username) throws (1:Err err),

    void bind() throws (1:Err err),
    // unbind phone must verify email, vice versa
    void unbind() throws (1:Err err)
}