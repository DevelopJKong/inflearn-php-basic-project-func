<div id="main__index" class="uk-container">
    <ul class="uk-list">
        <!--여기서 $posts가 하나도 없으면 안되는식 같아 보인다 -->
        <?php foreach ($posts as $post): ?>
        <li>
            <article class="uk-article">
                <h1 class="uk-article-title">
                    <a href="<?=$post['url']?>" class="uk-link-reset"><?=$post['title']?></a>
                </h1>
                <div class="uk-text-meta">by <?=$post['username']?></div>
                <p class="uk-margin"><?=$post['content']?></p>
                <div class="uk-text-meta"><?=$post['created_at']?></div>
            </article>
            <hr />
        </li>
        <?php endforeach;?>
    </ul>
</div>
<button id="readmore" class="uk-button uk-button-default">Read more</button>