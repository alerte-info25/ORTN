@php
    $start = \Carbon\Carbon::parse($event->start_date);
    $status = $start->isFuture() ? 'À venir' : 'En cours';
    $statusClass = $start->isFuture() ? 'upcoming' : 'ongoing';
@endphp

<div class="event-card" data-category="{{ strtolower($event->category) }} {{ $statusClass }}">
    <div style="position: relative;">
        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->event_name }}" class="event-image">
        <span class="event-category">{{ ucfirst($event->category) }}</span>
        <span class="event-status {{ $statusClass }}">{{ $status }}</span>
    </div>
    <div class="event-content">
        <div class="event-date-info">
            <div class="event-date-box">
                <div class="event-date-day">{{ $start->format('d') }}</div>
                <div class="event-date-month">{{ $start->translatedFormat('M') }}</div>
            </div>
            <div class="event-meta">
                <div class="event-meta-item">
                    <i class="fas fa-clock"></i>
                    <span>{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}</span>
                </div>
                <div class="event-meta-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ $event->address ?? 'Lieu non précisé' }}</span>
                </div>
            </div>
        </div>
        <h3 class="event-title">{{ $event->event_name }}</h3>
        <p class="event-description">{{ Str::limit($event->description, 160) }}</p>
        <div class="event-footer">
            <div class="event-participants">
                <i class="fas fa-users"></i>
                <span class="participants-count">{{ $event->participants->count() }}</span> inscrits
            </div>
            <a href="{{ route("ortn.evenements.show", ["slug" => $event->slug]) }}" class="event-btn">Détails</a>
        </div>
    </div>
</div>
