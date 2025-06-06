<style>/* General section styling */
section.articles-section {
    background-color: #ffffff;
}
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 1rem;
    display: flex;
    flex-direction: column;
    gap:0.5rem;
    align-items:center;
}

/* Article card */
.article-card {
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    margin-bottom: 2rem;
    transition: transform 0.2s ease;
    max-width:60vw;
    object-fit: cover;
    margin:2vw;
    width:50vw;
}

.article-card:hover {
    transform: scale(1.03,1.03);
    background-color:rgb(245, 235, 235);
}

/* Image styling */
.article-card img {
    width: 100%;
    height: auto;
    object-fit: cover;
    max-height: 300px;

}

/* Card body */
.article-card .card-body {
    padding: 1.5rem;
}

.article-card h5 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #333;
    margin: 5px 0px 5px 0px;
}

.article-card .meta {
    color: #888;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.article-card .meta strong {
    color: #444;
}

.article-card p {
    color: #555;
    line-height: 1.6;
    font-size: 1rem;
}


/* Section heading */
.articles-section h2 {
    font-weight: 700;
    color: #b30000;
    margin-bottom: 2rem;
    text-align: center;
}
.submit {
    background-color:#851216;
    border: 1px white solid;
    border-radius:0.5vw;
    height:2vw;
    width:4vw;
    font-size:0.8vw;
    color:white;
}
.submit:hover{
  background-color:#dc3545;
}
.searchbar{
    background-color:white;
    border: 1px gray solid;
    border-radius:0.5vw;
    height:2vw;
    width:40vw;
    font-size:0.8vw;
    color:gray;
    padding:0 0.5vw 0 0.5vw;
}
</style>

<?php echo $__env->make('navigation.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<section class="articles-section">
    <div class="container">
        <h2 style="margin-bottom:5px;">Health Articles</h2>
        <h3 style="margin-bottom:5px;">Search for Articles</h3>
        <form action="<?php echo e(route('articles.search')); ?>" method="GET" class="mb-4" style="margin-top:0px;">
        <input 
            type="text" 
            name="query" 
            placeholder="Search by headline, date, description, or author..." 
            value="<?php echo e(request('query')); ?>" 
            class="searchbar"
        />
        <button type="submit" class="submit">Search</button>
        </form>
        <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="article-card">
            <?php if(Str::startsWith($article->img, 'http')): ?>
                <img src="<?php echo e($article->img); ?>" alt="Article Image">
            <?php else: ?>
                <img src="<?php echo e(asset('storage/' . $article->img)); ?>" alt="Article Image">
            <?php endif; ?>
                <div class="card-body">
                    <h5><?php echo e($article->header); ?></h5>
                    <div class="meta">
                        by <strong><?php echo e($article->author ?? 'Unknown'); ?></strong> 
                        on <?php echo e(\Carbon\Carbon::parse($article->created_at)->format('F j, Y')); ?>

                    </div>
                    <p><?php echo e(Str::limit(strip_tags($article->description), 300)); ?></p>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php echo $__env->make('navigation.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</section><?php /**PATH D:\Codingan\SI46INT-KEL3-main\resources\views/articles/index.blade.php ENDPATH**/ ?>