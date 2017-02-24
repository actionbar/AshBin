
struct Address{
    1: required string email,
    2: optional string name
}

struct Body{
    1: required string subject,
    2: required string msg_html,
    3: optional string msg_plain
}

struct EmailSt{
    1: required Address from,
    2: required Address to,
    3: optional Body body,
    4: optional Address to_cc,
    5: optional Address to_bcc
}

service Email{
    void send(1: EmailSt email_st) throws () 
}