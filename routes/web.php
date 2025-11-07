<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Back\Dashboard\CommuniqueController;
use App\Http\Controllers\Back\Dashboard\EventController as DashboardEventController;
use App\Http\Controllers\Back\Dashboard\NewsletterController;
use App\Http\Controllers\Back\Dashboard\ParticipantController;
use App\Http\Controllers\Back\Dashboard\RedacteurController;
use App\Http\Controllers\Back\Dashboard\sondageController;
use App\Http\Controllers\Back\Dashboard\StoreArticleController;
use App\Http\Controllers\Back\Dashboard\StorePodcastAudioController;
use App\Http\Controllers\Back\Dashboard\StorePodcastVideoController;
use App\Http\Controllers\Back\Dashboard\StoreProgrammeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Front\Actualite\UserActualiteController;
use App\Http\Controllers\Front\Communiques\CommuniquesController;
use App\Http\Controllers\Front\Events\PaymentController;
use App\Http\Controllers\Front\Events\UserEventsController;
use App\Http\Controllers\Front\Newsletter\NewsletterController as NewsletterNewsletterController;
use App\Http\Controllers\Front\Podcast\PodcastController;
use App\Http\Controllers\Front\Programme\ProgrammeController;
use App\Http\Controllers\Front\User\ClientController;
use App\Http\Controllers\Front\User\HomeController;
use App\Http\Controllers\Front\User\UserAbonneController;
use App\Http\Controllers\Front\User\UserSendMessageController;
use App\Http\Controllers\Front\User\UserServiceController;
use App\Http\Controllers\UserCommentController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| front end Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, "index"])->name("ortn.home");

// actualités routes
Route::get('/actualites', [UserActualiteController::class, "index"])->name("ortn.actualites");
Route::get('/showArticles/{slug}', [UserActualiteController::class, "render"])->name("ortn.showArticles");
Route::get('/showArticleByCategory/{category}', [UserActualiteController::class, "showByCategorie"])->name("ortn.showArticleByCategory");

// podcasts routes 
Route::get('/podcasts/audio', [PodcastController::class, "indexAudio"])->name("ortn.podcasts");
Route::get('/podcasts/video', [PodcastController::class, "indexVideo"])->name("ortn.podcastsvideos");

// Newsletters routes
Route::post('/newsletters', [NewsletterNewsletterController::class, "store"])->name("ortn.newsletters.store");

// Commentaires routes
Route::post('/comments', [UserCommentController::class, "store"])->name("ortn.comments.store");

// contact route
Route::get('/contact', [UserSendMessageController::class, "index"])->name("ortn.contact");
Route::post('/contact', [UserSendMessageController::class, "send"])->name("ortn.contact.send");

// programme route
Route::get('/programmes', [ProgrammeController::class, "index"])->name("ortn.programmes");

// à propos route
Route::get('/a-propos', function () {
    return view('Front.About.index');
})->name("ortn.about");

// évènements route
Route::get('/evenements', [UserEventsController::class, "index"])->name("ortn.evenements");
Route::get('/evenements/{slug}/detail', [UserEventsController::class, "show"])->name("ortn.evenements.show");

Route::get('payments/{slug}', [PaymentController::class, 'index'])->name("ortn.payments");
Route::post('payments/{slug}/store', [PaymentController::class, 'store'])->name("ortn.payments.store");

Route::withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
    ->group(function () {
        Route::any('payments/return', [PaymentController::class, 'paymentReturn'])->name('payment.return');
        Route::post('payments/notify', [PaymentController::class, 'paymentNotify'])->name('payment.notify');
    });

// communiques route
Route::get("communiques", [CommuniquesController::class, "index"])->name("ortn.communiques");
Route::get("communiques/liste", [CommuniquesController::class, "show"])->name("ortn.communiques.liste");

/*
|--------------------------------------------------------------------------
| auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(AuthController::class)
    ->name("ortn.")
    ->group(function () {

    Route::get('/login', "showLoginForm")->name("login")->middleware('guest');
    Route::post('/login', "login")->name("login.post")->middleware('guest');
    Route::get('/register', "showRegisterForm")->name("register")->middleware('guest');
    Route::post('/register', "register")->name("register.post")->middleware('guest');
    Route::post("/logout", "logout")->name("logout");

});




/*
|--------------------------------------------------------------------------
| back end Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix("dashboard")
    ->name("dashboard.")
    ->middleware(['auth', 'role:admin,redacteur'])
    ->group(function () {

        // gestion des podcasts audios
        Route::get("/audios", [StorePodcastAudioController::class, "index"])->name("audios");
        Route::post("/audios", [StorePodcastAudioController::class, "store"])->name("audios.store");
        Route::get("/audiosList", [StorePodcastAudioController::class, "render"])->name("audiosList");
        Route::delete("/audiosList/{audio}", [StorePodcastAudioController::class, "destroy"])->name("audio.destroy");
        Route::get("/audiosList/{audio}/edit", [StorePodcastAudioController::class, "edit"])->name("audios.edit");
        Route::put("/audiosList/{audio}", [StorePodcastAudioController::class, "update"])->name("audios.update");

        // gestion des podcasts videos
        Route::get("/videos", [StorePodcastVideoController::class, "index"])->name("videos");
        Route::post("/videos", [StorePodcastVideoController::class, "store"])->name("videos.store");
        Route::get("/videosList", [StorePodcastVideoController::class, "render"])->name("videosList");
        Route::delete("/videosList/{audio}", [StorePodcastVideoController::class, "destroy"])->name("videos.destroy");
        Route::get("/videos/{video}/edit", [StorePodcastVideoController::class, "edit"])->name("videos.edit");
        Route::put("/videos/{video}", [StorePodcastVideoController::class, "update"])->name("videos.update");

        // gestion des articles
        Route::get("/articles", [StoreArticleController::class, "index"])->name("articles");
        Route::get("/articlesList", [StoreArticleController::class, "render"])->name("articlesListe");
        Route::get("/articles/{article}/edit", [StoreArticleController::class, "edit"])->name("articles.edit");
        Route::post("/articles", [StoreArticleController::class, "store"])->name("articles.store");
        Route::put("/articles/{article}", [StoreArticleController::class, "update"])->name("articles.update");
        Route::delete("/articles/{article}", [StoreArticleController::class, "destroy"])->name("articles.destroy");

        // gestion des programmes
        Route::get("/programmes", [StoreProgrammeController::class, "index"])->name("programmes");
        Route::get("/programmesList", [StoreProgrammeController::class, "render"])->name("programmesList");
        Route::post("/programmes", [StoreProgrammeController::class, "store"])->name("programmes.store");
        Route::get("/programmes/edit", [StoreProgrammeController::class, "edit"])->name("programmes.edit");
        Route::delete("/programmes/{programme}", [StoreProgrammeController::class, "destroy"])->name("programmes.destroy");
        Route::put("/programmes/{programme}/update", [StoreProgrammeController::class, "render"])->name("programmes.update");

        // gestion des newsletters
        Route::get("/newsletters", [NewsletterController::class, "index"])->name("newsletters");
        Route::post("/newsletters", [NewsletterController::class, "store"])->name("newsletters.store");
        Route::get("/newslettersListe", [NewsletterController::class, "render"])->name("newslettersListe");

        // liste des abonnées à la newsletter
        Route::get("/abonnes", [UserAbonneController::class, "index"])->name("abonnes");

        // liste des inscrits
        Route::get("/inscrits", [ClientController::class, "render"])->name("inscrits");

        // gestion des sondages
        Route::get("/sondages", [sondageController::class, "index"])->name("sondages");
        Route::post("/sondages", [sondageController::class, "store"])->name("sondages.post");
        Route::get("/sondagesListe", [sondageController::class, "render"])->name("sondagesListe");
        Route::delete("/sondagesListe/{sondage}", [sondageController::class, "delete"])->name("sondage.delete");

        // gestion des redacteurs
        Route::get("/redacteurs", [RedacteurController::class, 'form'])->name("redacteurs");
        Route::post("/redacteurs", [RedacteurController::class, 'store'])->name("redacteurs.post");
        Route::get("/redacteursListe", [RedacteurController::class, 'render'])->name("redacteursListe");
        Route::delete("/redacteursListe/{redacteur}", [RedacteurController::class, 'delete'])->name("redacteur.delete");

        // gestion des évènements
        Route::get('events/liste', [DashboardEventController::class, 'liste'])->name('events.liste');
        Route::get('events/create', [DashboardEventController::class, 'create'])->name('events.create');
        Route::post('events/', [DashboardEventController::class, 'store'])->name('events.store');
        Route::get('events/{slug}', [DashboardEventController::class, 'show'])->name('events.show');
        Route::delete('events/{id}', [DashboardEventController::class, 'destroy'])->name('events.destroy');
        Route::get('events/{slug}/participants', [ParticipantController::class, 'showByEvent'])->name('events.participants');

        // gestion des communiques
        Route::get("/communiques", [CommuniqueController::class, "index"])->name("communiques");
        Route::get("/communiques/liste", [CommuniqueController::class, "liste"])->name("communiques.liste");
        Route::post('communiques', [CommuniqueController::class, 'store'])->name('communiques.store');
        Route::delete('communiques/{communique:slug}', [CommuniqueController::class, 'destroy'])->name('communiques.destroy');
        Route::get('communiques/{communique:slug}', [CommuniqueController::class, 'show'])->name('communiques.show');

});
