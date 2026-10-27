@extends('layouts.app')

@section('title', $post->title . ' | ' . \App\Models\Setting::get('site_name', 'Structurflex ME'))
@section('description', $post->excerpt)

@section('content')
<!-- Article Banner -->
<section style="background: #081C38; color: #fff; padding: clamp(5.5rem, 10vw, 7.5rem) 0 clamp(3rem, 6vw, 4.5rem); position: relative; overflow: hidden;">
  <div class="container" style="position: relative; z-index: 2; max-width: 860px;">
    <div class="breadcrumbs" style="margin-top: 1.5rem; margin-bottom: 1.25rem; font-size: 0.85rem; color: #94a3b8; display: flex; flex-wrap: wrap; align-items: center; gap: 0.35rem;">
      <a href="{{ route('home') }}" style="color: #cbd5e1; text-decoration: none;">Home</a>
      <span style="color: #64748b;">/</span>
      <a href="{{ route('blog.index') }}" style="color: #cbd5e1; text-decoration: none;">Insights</a>
      <span style="color: #64748b;">/</span>
      <span style="color: #f3b90d;">{{ $post->category }}</span>
    </div>

    <div style="display: flex; gap: 0.75rem; align-items: center; margin-bottom: 1rem; flex-wrap: wrap;">
      <span class="section-tag" style="background: rgba(255, 255, 255, 0.12); color: #f3b90d; border: 1px solid rgba(255, 255, 255, 0.2); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; padding: 0.3rem 0.85rem; border-radius: 999px;">
        {{ $post->category }}
      </span>
      <span style="font-size: 0.85rem; color: #cbd5e1;">⏱ {{ $post->reading_time_minutes ?? 6 }} Min Read</span>
      <span style="font-size: 0.85rem; color: #94a3b8;">By {{ $post->author ?? 'Structurflex Technical Team' }}</span>
    </div>

    <h1 style="font-size: clamp(1.75rem, 5vw, 2.75rem); font-weight: 800; color: #ffffff; margin: 0 0 1.25rem; line-height: 1.25;">
      {{ $post->title }}
    </h1>

    <p style="font-size: clamp(1rem, 2.2vw, 1.2rem); color: #cbd5e1; line-height: 1.6; margin: 0;">
      {{ $post->excerpt }}
    </p>
  </div>
</section>

<!-- Article Body -->
<section class="section" style="background-color: #F8FAFC; padding: clamp(3rem, 6vw, 5rem) 0;">
  <div class="container" style="max-width: 860px;">
    @if($post->featured_image)
    <div style="border-radius: 14px; overflow: hidden; margin-bottom: 2.5rem; box-shadow: 0 12px 30px rgba(0,0,0,0.08); background: #081C38;">
      <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" style="width: 100%; height: auto; display: block;">
    </div>
    @endif

    <div class="insight-article-content" style="background: #ffffff; border-radius: 14px; padding: clamp(1.5rem, 4vw, 3rem); border: 1.5px solid #e2e8f0; font-size: 1.05rem; color: #334155; line-height: 1.85; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
      {!! nl2br(e($post->content)) !!}
    </div>

    <!-- Back to Hub & Contact Buttons -->
    <div class="insight-article-actions" style="margin-top: 3rem; display: flex; justify-content: space-between; align-items: center; gap: 1rem; flex-wrap: wrap;">
      <a href="{{ route('blog.index') }}" class="btn btn-hero-white">
        <span>&larr; Back to Insights Hub</span>
      </a>
      <a href="{{ route('contact.index') }}" class="btn btn-request-consult">
        <span>Consult Our Authors</span>
        <span>&rarr;</span>
      </a>
    </div>
  </div>
</section>
@endsection
