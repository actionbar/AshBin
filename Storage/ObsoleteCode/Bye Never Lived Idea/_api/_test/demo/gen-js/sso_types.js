//
// Autogenerated by Thrift Compiler (0.9.1)
//
// DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
//


if (typeof Tf === 'undefined') {
  Tf = {};
}
if (typeof Tf.Sso === 'undefined') {
  Tf.Sso = {};
}
Tf.Sso.ErrIdEnum = {
'ERR_UNKNOWN' : 1,
'ERR_SERVER' : 2,
'ERR_NOT_EXISTS' : 3,
'ERR_REPEATED' : 4,
'ERR_USER_INPUT' : 5,
'ERR_CAPTCHA' : 6,
'ERR_VERIFY' : 7,
'ERR_PERMISSION' : 8
};
Tf.Sso.AccountTypeEnum = {
'USERNAME' : 1,
'PHONE' : 2,
'EMAIL' : 3
};
Tf.Sso.Err = function(args) {
  this.id = null;
  this.msg = null;
  if (args) {
    if (args.id !== undefined) {
      this.id = args.id;
    }
    if (args.msg !== undefined) {
      this.msg = args.msg;
    }
  }
};
Thrift.inherits(Tf.Sso.Err, Thrift.TException);
Tf.Sso.Err.prototype.name = 'Err';
Tf.Sso.Err.prototype.read = function(input) {
  input.readStructBegin();
  while (true)
  {
    var ret = input.readFieldBegin();
    var fname = ret.fname;
    var ftype = ret.ftype;
    var fid = ret.fid;
    if (ftype == Thrift.Type.STOP) {
      break;
    }
    switch (fid)
    {
      case 1:
      if (ftype == Thrift.Type.I32) {
        this.id = input.readI32().value;
      } else {
        input.skip(ftype);
      }
      break;
      case 2:
      if (ftype == Thrift.Type.STRING) {
        this.msg = input.readString().value;
      } else {
        input.skip(ftype);
      }
      break;
      default:
        input.skip(ftype);
    }
    input.readFieldEnd();
  }
  input.readStructEnd();
  return;
};

Tf.Sso.Err.prototype.write = function(output) {
  output.writeStructBegin('Err');
  if (this.id !== null && this.id !== undefined) {
    output.writeFieldBegin('id', Thrift.Type.I32, 1);
    output.writeI32(this.id);
    output.writeFieldEnd();
  }
  if (this.msg !== null && this.msg !== undefined) {
    output.writeFieldBegin('msg', Thrift.Type.STRING, 2);
    output.writeString(this.msg);
    output.writeFieldEnd();
  }
  output.writeFieldStop();
  output.writeStructEnd();
  return;
};

Tf.Sso.SignInSt = function(args) {
  this.account = null;
  this.account_type = null;
  this.pwd = null;
  this.captcha = null;
  if (args) {
    if (args.account !== undefined) {
      this.account = args.account;
    }
    if (args.account_type !== undefined) {
      this.account_type = args.account_type;
    }
    if (args.pwd !== undefined) {
      this.pwd = args.pwd;
    }
    if (args.captcha !== undefined) {
      this.captcha = args.captcha;
    }
  }
};
Tf.Sso.SignInSt.prototype = {};
Tf.Sso.SignInSt.prototype.read = function(input) {
  input.readStructBegin();
  while (true)
  {
    var ret = input.readFieldBegin();
    var fname = ret.fname;
    var ftype = ret.ftype;
    var fid = ret.fid;
    if (ftype == Thrift.Type.STOP) {
      break;
    }
    switch (fid)
    {
      case 1:
      if (ftype == Thrift.Type.STRING) {
        this.account = input.readString().value;
      } else {
        input.skip(ftype);
      }
      break;
      case 2:
      if (ftype == Thrift.Type.I32) {
        this.account_type = input.readI32().value;
      } else {
        input.skip(ftype);
      }
      break;
      case 3:
      if (ftype == Thrift.Type.STRING) {
        this.pwd = input.readString().value;
      } else {
        input.skip(ftype);
      }
      break;
      case 4:
      if (ftype == Thrift.Type.STRING) {
        this.captcha = input.readString().value;
      } else {
        input.skip(ftype);
      }
      break;
      default:
        input.skip(ftype);
    }
    input.readFieldEnd();
  }
  input.readStructEnd();
  return;
};

Tf.Sso.SignInSt.prototype.write = function(output) {
  output.writeStructBegin('SignInSt');
  if (this.account !== null && this.account !== undefined) {
    output.writeFieldBegin('account', Thrift.Type.STRING, 1);
    output.writeString(this.account);
    output.writeFieldEnd();
  }
  if (this.account_type !== null && this.account_type !== undefined) {
    output.writeFieldBegin('account_type', Thrift.Type.I32, 2);
    output.writeI32(this.account_type);
    output.writeFieldEnd();
  }
  if (this.pwd !== null && this.pwd !== undefined) {
    output.writeFieldBegin('pwd', Thrift.Type.STRING, 3);
    output.writeString(this.pwd);
    output.writeFieldEnd();
  }
  if (this.captcha !== null && this.captcha !== undefined) {
    output.writeFieldBegin('captcha', Thrift.Type.STRING, 4);
    output.writeString(this.captcha);
    output.writeFieldEnd();
  }
  output.writeFieldStop();
  output.writeStructEnd();
  return;
};

Tf.Sso.SignInfoSt = function(args) {
  this.username = null;
  this.email = null;
  this.phone = null;
  if (args) {
    if (args.username !== undefined) {
      this.username = args.username;
    }
    if (args.email !== undefined) {
      this.email = args.email;
    }
    if (args.phone !== undefined) {
      this.phone = args.phone;
    }
  }
};
Tf.Sso.SignInfoSt.prototype = {};
Tf.Sso.SignInfoSt.prototype.read = function(input) {
  input.readStructBegin();
  while (true)
  {
    var ret = input.readFieldBegin();
    var fname = ret.fname;
    var ftype = ret.ftype;
    var fid = ret.fid;
    if (ftype == Thrift.Type.STOP) {
      break;
    }
    switch (fid)
    {
      case 1:
      if (ftype == Thrift.Type.STRING) {
        this.username = input.readString().value;
      } else {
        input.skip(ftype);
      }
      break;
      case 2:
      if (ftype == Thrift.Type.STRING) {
        this.email = input.readString().value;
      } else {
        input.skip(ftype);
      }
      break;
      case 3:
      if (ftype == Thrift.Type.STRING) {
        this.phone = input.readString().value;
      } else {
        input.skip(ftype);
      }
      break;
      default:
        input.skip(ftype);
    }
    input.readFieldEnd();
  }
  input.readStructEnd();
  return;
};

Tf.Sso.SignInfoSt.prototype.write = function(output) {
  output.writeStructBegin('SignInfoSt');
  if (this.username !== null && this.username !== undefined) {
    output.writeFieldBegin('username', Thrift.Type.STRING, 1);
    output.writeString(this.username);
    output.writeFieldEnd();
  }
  if (this.email !== null && this.email !== undefined) {
    output.writeFieldBegin('email', Thrift.Type.STRING, 2);
    output.writeString(this.email);
    output.writeFieldEnd();
  }
  if (this.phone !== null && this.phone !== undefined) {
    output.writeFieldBegin('phone', Thrift.Type.STRING, 3);
    output.writeString(this.phone);
    output.writeFieldEnd();
  }
  output.writeFieldStop();
  output.writeStructEnd();
  return;
};

Tf.Sso.SSO_COOKIE_NAME = {'sessId' : 'sso_sess_id',
'signInfo' : 'sso_sign_info'
};
