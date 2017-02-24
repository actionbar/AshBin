cd E:\root\www.luexu.com\api.luexu.com\Tf\

:: --gen php:server   ==> 生成PHP 服务端的, 

:: php (PHP):
::   inlined:         Generate PHP inlined files
::   server:          Generate PHP server stubs
::   oop:             Generate PHP with object oriente
::   rest:            Generate PHP REST processors
   
   
   
:: thrift --gen php:server E:\root\www.luexu.com\api.luexu.com\Tf\shared.thrift
:: thrift --gen php:server E:\root\www.luexu.com\api.luexu.com\Tf\sso.thrift
thrift -out E:\root\www.luexu.com\api.luexu.com\ --gen php:server E:\root\www.luexu.com\api.luexu.com\Tf\sso.thrift

 thrift -out E:\root\www.luexu.com\api.luexu.com\_test\demo\gen-js --gen js E:\root\www.luexu.com\api.luexu.com\Tf\sso.thrift


thrift -out E:\root\www.luexu.com\api.luexu.com\ --gen php:server E:\root\www.luexu.com\api.luexu.com\Tf\task.thrift

pause