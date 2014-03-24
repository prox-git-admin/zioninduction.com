<?php
$taxonomy     = 'team-category';
$order		  = 'ASC';
$show_count   = 0;      // 1 for yes, 0 for no
$pad_counts   = 0;      // 1 for yes, 0 for no
$hierarchical = 1;      // 1 for yes, 0 for no
$title        = '';
						
$args = array(
	'taxonomy'     => $taxonomy,
	'order'        => $order,
	'show_count'   => $show_count,
	'pad_counts'   => $pad_counts,
	'hierarchical' => $hierarchical,
	'title_li'     => $title
);
$term_obj =  get_terms($taxonomy,$args);
?>
<ul id="list-category-team">
					   <?php foreach ($term_obj as $term) : 		?>
                        <li><a href="<?php echo get_term_link($term, $taxonomy);?>"><?php echo $term->name;?></a></li>
						<?php endforeach;?>
       </ul>