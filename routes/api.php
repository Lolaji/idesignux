<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FeaturedController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MailingListController;
use App\Http\Controllers\MetadataController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceDeliverableController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\Metadata;
use App\Models\ServiceMilestone;
use App\Models\ServiceProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/auth/login', [AuthController::class, 'authenticate']);
Route::get('/services/navigation', [ServiceController::class, 'fetchNavigation']);
Route::post('/contacts', [ContactController::class, 'upsert']);

Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    Route::post('/users/{id}/{relationName}/{relationId?}', [UserController::class, 'upsertByForeign']);
    
    Route::get('/contacts', [ContactController::class, 'fetch']);
    Route::get('/contacts/unread', [ContactController::class, 'fetch']);
    
    Route::post('/services/{service?}', [ServiceController::class, 'upsert']);
    Route::post('/services/{service}/{relationName}/{relationId?}', [ServiceController::class, 'upsertByForeign']);
    Route::patch('/services/{service}/relationship/{relationship}', [ServiceController::class, 'deattach']);
    Route::delete('/services/{id}', [ServiceController::class, 'destroy']);
    
    
    Route::get('/portfolios', [PortfolioController::class, 'fetch']);
    Route::post('/portfolios/{id?}', [PortfolioController::class, 'upsert']);
    Route::post('/portfolios/{portfolio}/{relationName}/{relationId?}', [PortfolioController::class, 'upsertByForeign']);
    Route::patch('/portfolios/{portfolio}/column/{column}', [PortfolioController::class, 'saveColumn']);
    Route::delete('/portfolios/{id}', [PortfolioController::class, 'destroy']);
    
    
    Route::post('/posts/{post}/{relationName}/{relationId?}', [BlogController::class, 'upsertByForeign']);
    Route::delete('/posts/{id}', [BlogController::class, 'destroy']);
    
    
    Route::post('/tags/{id?}', [TagController::class, 'upsert']);
    Route::delete('/tags/{id}', [TagController::class, 'destroy']);
    
    
    Route::post('/categories/{id?}', [CategoryController::class, 'upsert']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
    
    
    Route::post('/mailing_list/{id?}', [MailingListController::class, 'upsert']);
    Route::delete('/mailing_list/{id}', [MailingListController::class, 'destroy']);
    
    Route::post('/reviews/{id?}', [ReviewController::class, 'upsert']);
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);
    
    Route::get('/explorer/{path?}', [FileManagerController::class, 'fetch']);
    Route::post('/explorer', [FileManagerController::class, 'delsert']);
    Route::post('/explorer/upload', [FileManagerController::class, 'upload']);
    
    Route::delete('/metadata/{id}', [MetadataController::class, 'destroy']);
    Route::delete('/milestones/{id}', [ServiceMilestone::class, 'destroy']);
    Route::delete('/deliverables/{id}', [ServiceDeliverableController::class, 'destroy']);
    Route::delete('/processes/{id}', [ServiceProcess::class, 'destroy']);
    Route::delete('/features/{id}', [FeaturedController::class, 'destroy']);
    Route::delete('/images/{id}', [ImageController::class, 'destroy']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Broadcast::routes(['middleware' => ['auth:sanctum']]);
