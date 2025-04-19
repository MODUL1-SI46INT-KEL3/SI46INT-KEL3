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
    gap: 2rem;
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
</style>

@include('navigation.navbar')
<section class="articles-section">
    <div class="container">
        <h2>Health Articles</h2>

        @foreach($articles as $article)
            <div class="article-card">
                <img src="{{ $article->img }}" alt="Article Image">
                <div class="card-body">
                    <h5>{{ $article->header }}</h5>
                    <div class="meta">
                        by <strong>{{ $article->author ?? 'Unknown' }}</strong> 
                        on {{ \Carbon\Carbon::parse($article->created_at)->format('F j, Y') }}
                    </div>
                    <p>{{ Str::limit(strip_tags($article->description), 300) }}</p>
                </div>
            </div>
        @endforeach
    </div>
@include('navigation.footer')
</section>