<?php
  // You can simulate a slow server with sleep
  // sleep(2);

  function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
  }

  // Typically, this would be a call to a database
  function find_blog_posts($page) {
    $first_post = 101;
    $per_page = 3;
    $offset = (($page - 1) * $per_page) + 1;

    $blog_posts = [];
    // This is our "fake" database
    for($i=0; $i < $per_page; $i++) {
      $id = $first_post - 1 + $offset + $i;
      $blog_post = [
        'id' => $id,
        'title' => "Blog Post #{$id}",
        'content' =>A very inspiring blog that contains motivational stories about startups and the people who work in them and create them. If you need a pick me up after a bad day at the office or think that you can’t become that person who goes it along and starts up something awesome, then why not have a read. You’ll soon hear about people who literally only had the shirt on their backs and who rose up to be a success in business and in life.      ];
      $blog_posts[] = $blog_post;
    }
    return $blog_posts;
  }

  if(!is_ajax_request()) { exit; }

  $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

  $blog_posts = find_blog_posts($page);

?>
<?php foreach($blog_posts as $blog_post) { ?>
  <div id="blog-post-<?php echo $blog_post['id']; ?>" class="blog-post">
    <h3><?php echo $blog_post['title']; ?></h3>
    <p><?php echo $blog_post['content']; ?></p>
  </div>
<?php } ?>
