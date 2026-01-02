<article class="service-card" role="article" aria-labelledby="service-{{ $service->id }}">
    <a class="card-link" href="{{ route('service.show', $service->id) }}">
        <div class="card-media" aria-hidden="true">
            <div class="placeholder-img">خدمة</div>
        </div>
        <div class="card-body">
            <h3 id="service-{{ $service->id }}" class="card-title">{{ $service->name }}</h3>
            <p class="card-desc">{{ Str::limit($service->description, 120) }}</p>
        </div>
        <div class="card-meta">
            <span class="price">{{ $service->formatted_price }}</span>
            @if($service->duration_formatted)
                <span class="duration">{{ $service->duration_formatted }}</span>
            @endif
        </div>
    </a>
</article>
