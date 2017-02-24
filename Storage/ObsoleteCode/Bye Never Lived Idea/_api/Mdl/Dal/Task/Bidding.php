<?php
namespace Mdl\Dal\Task;

class Bidding{
    const ID = 'i';
    const STATE = 'state';
    const ORDER = 'o';
    const BIDDEE = 'biddee';
    const SORTS = 'sort';
    const TRANSACTION = 'transaction';
    const UNIT_PRICE = 'unitprice';
    const SHARES = 'shares';
    const BIDDERS = 'bidders';
    const BOND = 'bond';
    const WINNERS = 'winners';
    const TITLE = 'h';
    const DESCRIPTION = 'd';
    const KEYWORDS = 'k';
    const DEADLINE = 'deadline';
    const TEXT = 'f';
    const PRIVACY = 'privacy';
    const LON = 'lon';
    const LAT = 'lat';
    const TIME_NOW = 't';
    
    public $id;
    public $state;
    public $order;
    public $biddee;
    public $sorts;
    public $transaction;
    public $unitPrice;
    public $shares;
    public $bond;
    public $bidders;
    public $winners;
    public $title;
    public $description;
    public $keywords;
    public $text;
    public $deadline;
    public $privacy;
    public $lon; 
    public $lat;
    public $timeNow;
    


    public function insert(){
        return 'INSERT INTO task_bidding SET
        state=0,
        o=0,
        privacy=' . $this->privacy . ',
        biddee="' . $this->biddee . '",
        sort=' . $this->sorts . ',
        transaction=' . $this->transaction . ',
        unitprice=' . $this->unitPrice . ',
        shares=' . $this->shares . ',
        bond=' . $this->bond . ',
        bidders=' . $this->bidders . ',
        winners=' . $this->winners . ',
        h="' . $this->title . '",
        k="' . $this->keywords . '",
        d="' . $this->description . '",
        f="' . $this->text . '",
        t="' . $this->timeNow . '",
        deadline=' . $this->deadline . ',
        lon=' . $this->lon . ',
        lat=' . $this->lat . '
        ';

    }

    //文章一旦发布不可以修改，但是可以添加新内容，添加新内容自动追在文章尾部，原内容不可以编辑，用<div class="task-add"><h2>修改说明小标题<em>2014-20-23 22:33:20</em></h2>说明的内容，可能包括图片、html标签</div>
    public function supplement(){
        return 'UPDATE task_bidding SET
        f=concat(f, "' . $this->text . '")
        WHERE
         i=' . $this->id . '
        AND
         biddee = "' . $this->biddee . '"';
    }


    public function queryOne(){
        return 'SELECT * FROM task_bidding WHERE i=' . $this->id . ' LIMIT 1';
    }

    public function query(){
        return 'SELECT * FROM task_bidding WHERE 1=1 ORDER BY t DESC LIMIT 20';
    }



}