<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podcasts Vidéo - ortn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    {{-- local css --}}
    <link rel="stylesheet" href="{{ asset("css/Front/Podcasts/podcastsvideo.css") }}">
</head>
<body>

    <!-- Loader -->
    @include("Front.partials.loader")

    @include("Front.partials.header")

    <!-- Social Media Fixed Buttons -->

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <div class="page-header-content">
                @if (session()->has("alert"))
                    <div class="alert alert-{{ session("alert")["type"] }}">
                        {{ session("alert")["message"] }}
                    </div>
                @endif
                <h1 class="page-title">
                    <i class="fas fa-video"></i>
                    Podcasts Vidéo
                </h1>
                <p class="page-description">
                    Découvrez nos émissions et podcasts vidéo exclusifs. Reportages, interviews, documentaires et émissions à regarder quand vous voulez, où vous voulez.
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-8">

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-16">
                <!-- Latest Videos -->
                <div class="section-header">
                    <h2 class="section-title">Dernières vidéos</h2>
                </div>

                <div class="row">
                    
                    @forelse ($videos as $video)
                        @php
                            $rawLink = $video->url_video ?? '#';

                            // ID unique pour le modal
                            $modalId = 'videoModal_' . $loop->index;

                            // lien embed pour iframe
                            if (Str::contains($rawLink, 'watch?v=')) {
                                $videoId = last(explode('watch?v=', $rawLink));
                                $videoLink = 'https://www.youtube.com/embed/' . $videoId;
                                $thumbnail = 'https://img.youtube.com/vi/' . $videoId . '/hqdefault.jpg';
                            } elseif (Str::contains($rawLink, 'youtu.be/')) {
                                $videoId = last(explode('youtu.be/', $rawLink));
                                $videoLink = 'https://www.youtube.com/embed/' . $videoId;
                                $thumbnail = 'https://img.youtube.com/vi/' . $videoId . '/hqdefault.jpg';
                            } else {
                                // fallback image si ce n'est pas YouTube
                                $videoLink = $rawLink;
                                $thumbnail = 'https://via.placeholder.com/800x450?text=Vidéo';
                            }
                        @endphp

                        <div class="col-md-6 mb-4">
                            <div class="video-card">
                                <div class="video-image position-relative">
                                    <img src="{{ $thumbnail }}" alt="Vidéo {{ $video->media->titre }}" class="img-fluid rounded">
                                    <div class="video-overlay d-flex justify-content-center align-items-center">
                                        <button class="play-btn-overlay btn btn-light rounded-circle shadow"
                                            data-bs-toggle="modal"
                                            data-bs-target="#{{ $modalId }}">
                                            <i class="fas fa-play"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="video-body mt-3">
                                    <span class="video-category text-primary fw-semibold">{{ $video->categorieVideo->libelle ?? 'Non catégorisé' }}</span>
                                    <h5 class="video-title fw-bold mt-2">{{ $video->media->titre }}</h5>
                                    <p class="video-description text-muted">
                                        {!! Str::limit(strip_tags($video->media->description), 150, '...') !!}
                                    </p>
                                    <div class="video-footer d-flex justify-content-between align-items-center">
                                        <small class="text-secondary"><i class="far fa-calendar me-1"></i> {{ $video->created_at->diffForHumans() }}</small>
                                        @if(isset($video->media->auteur))
                                            <small class="text-secondary">Auteur : {{ $video->media->auteur }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal détaillé -->
                        <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">{{ $video->media->titre }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="ratio ratio-16x9 mb-3">
                                            <iframe src="{{ $videoLink }}" title="{{ $video->media->titre }}"
                                                allowfullscreen
                                                allow="autoplay; encrypted-media">
                                            </iframe>
                                        </div>
                                        <p><strong>Catégorie :</strong> {{ $video->categorieVideo->libelle ?? 'N/A' }}</p>
                                        <p><strong>Description :</strong> {!! $video->media->description !!}</p>
                                        <p><strong>Date :</strong> {{ $video->created_at->format('d/m/Y H:i') }}</p>
                                        @if(isset($video->media->auteur))
                                            <p><strong>Auteur :</strong> {{ $video->media->auteur }}</p>
                                        @endif
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <p class="text-center text-muted">Aucune vidéo disponible pour le moment.</p>
                    @endforelse
                </div>

                {{ $videos->links() }}

            </div>
        </div>
    </div>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <div class="newsletter-icon">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <h2 class="newsletter-title">Restez informé en temps réel</h2>

                @if (session()->has("alert"))
                    <div class="alert alert-{{ session("alert")["type"] }}">
                        {{ session("alert")["message"] }}
                    </div>
                @endif

                <p class="newsletter-description">
                    Abonnez-vous à notre newsletter et recevez les dernières actualités directement dans votre boîte mail.
                </p>
                <form method="POST" action="{{ route("ortn.newsletters.store") }}">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Votre adresse email" required style="border-radius: 2px solid rgba(255,255,255,0.5); padding: 12px 20px; border: none;">
                    </div>
                    <button type="submit" class="btn w-100" style="background: white; color: var(--primary-red); border-radius: 2px solid rgba(255,255,255,0.5); padding: 12px; font-weight: 600; border: none;">
                        S'abonner maintenant
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include("Front.partials.footer")

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset("js/Front/Podcasts/podcastvideos.js") }}"></script>

</body>
</html>