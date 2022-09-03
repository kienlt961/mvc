

<?php
class Post
{
  public $id;
  public $title;
  public $context;

  function __construct($id, $title, $context)
  {
    $this->id = $id;
    $this->title = $title;
    $this->context = $context;
  }

  static function all()
  {
    $list = [];
    $db = DB::getInstance();
    $req = $db->query('SELECT * FROM posts');

    foreach ($req->fetchAll() as $item) {
      $list[] = new Post($item['id'], $item['title'], $item['context']);
    }

    return $list;
  }
static function find($id)
  {
    $db = DB::getInstance();
    $req = $db->prepare('SELECT * FROM posts WHERE id = :id');
    $req->execute(array('id' => $id));

    $item = $req->fetch();
    if (isset($item['id'])) {
      return new Post($item['id'], $item['title'], $item['context']);
    }
    return null;
  }
}

