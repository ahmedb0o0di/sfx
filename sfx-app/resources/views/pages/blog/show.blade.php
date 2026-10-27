@extends('layouts.app')

@section('title', $post->title . ' | ' . \App\Models\Setting::get('site_name'))
@section('description', $post->excerpt)

@section('content')
<!-- Article Banner -->
<section style="background: #081C38; color: #fff; padding: 7.5rem 0 4.5rem; position: relative; overflow: hidden;">
  <div class="container" style="position: relative; z-index: 2; max-width: 860px;">
    <div class="breadcrumbs" style="margin-top: 1.5rem; margin-bottom: 1.5rem; font-size: 0.85rem; color: #94a3b8;">
      <a href="{{ route('home') }}" style="color: #cbd5e1; text-decoration: none;">Home</a>
      <span style="margin: 0 0.5rem;">/</span>
      <a href="{{ route('blog.index') }}" style="color: #cbd5e1; text-decoration: none;">Insights</a>
      <span style="margin: 0 0.5rem;">/</span>
      <span style="color: #f3b90d;">{{ $post->category }}</span>
    </div>

    <div style="display: flex; gap: 1rem; align-items: center; margin-bottom: 1rem;">
      <span class="section-tag" style="background: rgba(255, 255, 255, 0.12); color: #f3b90d; border: 1px solid rgba(255, 255, 255, 0.2); font-weight: 700; font-size: 0.78rem; text-transform: uppercase; padding: 0.35rem 0.9rem; border-radius: 999px;">
        {{ $post->category }}
      </span>
      <span style="font-size: 0.85rem; color: #cbd5e1;">{{ $post->reading_time_minutes }} Min Read</span>
      <span style="font-size: 0.85rem; color: #94a3b8;">By {{ $post->author }}</span>
    </div>

    <h1 style="font-size: 2.75rem; font-weight: 800; color: #ffffff; margin: 0 0 1.25rem; line-height: 1.25;">
      {{ $post->title }}
    </h1>
    <p style="font-size: 1.2rem; color: #cbd5e1; line-height: 1.6; margin: 0;">
      {{ $post->excerpt }}
    </p>
  </div>
</section>

<!-- Article Body -->
<section class="section" style="background-color: #F8FAFC; padding: 5rem 0;">
  <div class="container" style="max-width: 860px;">
    @if($post->featured_image)
    <div style="border-radius: 12px; overflow: hidden; margin-bottom: 3rem; box-shadow: 0 15px 35px rgba(0,0,0,0.08);">
      <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" style="width: 100%; height: auto; display: block;">
    </div>
    @endif

    <div style="background: #ffffff; border-radius: 12px; padding: 3rem; border: 1px solid #e2e8f0; font-size: 1.1rem; color: #334155; line-height: 1.85;">
      {!! nl2br(e($post->content)) !!}
    </div>

    <!-- Back to Hub -->
    <div style="margin-top: 3rem; display: flex; justify-content: space-between; align-items: center;">
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
