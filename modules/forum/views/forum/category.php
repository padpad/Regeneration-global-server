<?php echo Message::render() ?>

<?php foreach ( $topics as $t ): ?>

<p>
<?php echo html::anchor( 'forum/topic/'.$t->id, $t->title ); ?>
<br />
Created by <?php echo $t->user->username ?> <?php echo MG::Ago($t->created) ?>

</p>

<?php endforeach;?>

<p>
<?php echo html::anchor( 'forum/category/'.$category->id.'/new_topic', 'Create topic' ); ?>
</p>

