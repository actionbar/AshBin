var errhanle = function(res){
  var errcode = parseInt(res.errcode),
      errmsg = res.errmsg;

  if(0 === errcode)     //
    errcode = E_OK;
  if(E_OK != errcode){
    alert(errcode + ': ' + errmsg);
    if(E_UNAUTHORIZED == errcode){
      localStorage.clear();
      window.location.href='/m-y-admin/';
    }
    return false;
  }
  return true;

}