<?php

namespace App\Providers;

use App\Models\Skill;
use App\Repository\Contracts\AdminRepositoryInterface;
use App\Repository\Contracts\CategoryRepositoryInterface;
use App\Repository\Contracts\CommissionRepositoryInterface;
use App\Repository\Contracts\FreelancerProfileRepositoryInterface;
use App\Repository\Contracts\HashtagRepositoryInterface;
use App\Repository\Contracts\InvitationFreelancerRepositoryInterface;
use App\Repository\Contracts\LanguageRepositoryInterface;
use App\Repository\Contracts\PortfolioAttachmentRepositoryInterface;
use App\Repository\Contracts\PortfolioRepositoryInterface;
use App\Repository\Contracts\ProjectAttachmentRepositoryInterface;
use App\Repository\Contracts\ProjectRepositoryInterface;
use App\Repository\Contracts\ProposalAttachmentRepositoryInterface;
use App\Repository\Contracts\ProposalRepositoryInterface;
use App\Repository\Contracts\ServiceAttachmentRepositoryInterface;
use App\Repository\Contracts\ServiceFaqRepositoryInterface;
use App\Repository\Contracts\ServiceRepositoryInterface;
use App\Repository\Contracts\SkillRepositoryInterface;
use App\Repository\Contracts\UserLanguageRepositoryInterface;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Repository\Contracts\UserVerificationRepositoryInterface;
use App\Repository\Eloquent\AdminRepository;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\CommissionRepository;
use App\Repository\Eloquent\FreelancerProfileRepository;
use App\Repository\Eloquent\HashtagRepository;
use App\Repository\Eloquent\InvitationFreelancerRepository;
use App\Repository\Eloquent\LanguageRepository;
use App\Repository\Eloquent\PortfolioRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\Eloquent\PortfolioAttachmentRepository;
use App\Repository\Eloquent\ProjectAttachmentRepository;
use App\Repository\Eloquent\ProjectRepository;
use App\Repository\Eloquent\ProposalAttachmentRepository;
use App\Repository\Eloquent\ProposalRepository;
use App\Repository\Eloquent\ServiceAttachmentRepository;
use App\Repository\Eloquent\ServiceFaqRepository;
use App\Repository\Eloquent\ServiceRepository;
use App\Repository\Eloquent\SkillRepository;
use App\Repository\Eloquent\UserLanguageRepository;
use App\Services\Contracts\Auth\AuthAdminServiceInterface;
use App\Services\Contracts\Auth\AuthUserServiceInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use App\Services\Contracts\Auth\EmailVerificationServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\ClientServiceInterface;
use App\Services\Contracts\FreelancerServiceInterface;
use App\Services\Contracts\LanguageServiceInterface;
use App\Services\Contracts\PortfolioServiceInterface;
use App\Services\Contracts\SkillServiceInterface;
use App\Services\Contracts\UserVerificationServiceInterface;
use App\Services\Implementations\Auth\AuthAdminService;
use App\Services\Implementations\Auth\AuthUserService;
use App\Services\Implementations\Auth\EmailVerificationService;
use App\Services\Implementations\CategoryService;
use App\Services\Implementations\ClientService;
use App\Services\Implementations\FreelancerService;
use App\Services\Implementations\LanguageService;
use App\Services\Implementations\PortfolioService;
use App\Services\Implementations\SkillService;
use App\Repository\Eloquent\UserVerificationRepository;
use App\Services\Contracts\CommissionServiceInterface;
use App\Services\Contracts\HashtagServiceInterface;
use App\Services\Contracts\HomeServiceInterface;
use App\Services\Implementations\UserVerificationService;
use App\Services\Upload\Contracts\UploadStrategyInterface;
use App\Services\Upload\Factory\UploadStrategyFactory;
use App\Services\Upload\Strategies\PortfolioUpload;
use App\Services\Contracts\InvitationFreelancerServiceInterface;
use App\Services\Contracts\ProjectServiceInterface;
use App\Services\Contracts\ProposalServiceInterface;
use App\Services\Contracts\ServiceServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Services\Implementations\CommissionService;
use App\Services\Implementations\HashtagService;
use App\Services\Implementations\HomeService;
use App\Services\Implementations\InvitationFreelancerService;
use App\Services\Implementations\ProjectService;
use App\Services\Implementations\ProposalService;
use App\Services\Implementations\ServiceService;
use App\Services\Implementations\UserService;
use App\Services\Search\Contracts\SearchStrategyInterface;
use App\Services\Search\Factory\SearchStrategyFactory;
use App\Services\Search\Strategies\ProjectSearch;
use App\Services\Search\Strategies\ServiceSearch;
use App\Services\Upload\Strategies\ProjectUpload;
use App\Services\Upload\Strategies\ProposalUpload;
use App\Services\Upload\Strategies\ServiceUpload;
use Illuminate\Database\Eloquent\Model;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EmailVerificationServiceInterface::class, EmailVerificationService::class);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(AuthUserServiceInterface::class, AuthUserService::class);

        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(AuthAdminServiceInterface::class, AuthAdminService::class);

        $this->app->bind(FreelancerProfileRepositoryInterface::class, FreelancerProfileRepository::class);

        $this->app->bind(FreelancerServiceInterface::class, FreelancerService::class);

        $this->app->bind(ClientServiceInterface::class, ClientService::class);

        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);

        $this->app->bind(PortfolioRepositoryInterface::class, PortfolioRepository::class);
        $this->app->bind(PortfolioServiceInterface::class, PortfolioService::class);

        $this->app->bind(HashtagRepositoryInterface::class, HashtagRepository::class);
        $this->app->bind(HashtagServiceInterface::class, HashtagService::class);

        $this->app->bind(PortfolioAttachmentRepositoryInterface::class, PortfolioAttachmentRepository::class);
        $this->app->bind(ServiceAttachmentRepositoryInterface::class, ServiceAttachmentRepository::class);
        $this->app->bind(ProjectAttachmentRepositoryInterface::class, ProjectAttachmentRepository::class);

        $this->app->bind(SkillRepositoryInterface::class, SkillRepository::class);
        $this->app->bind(SkillServiceInterface::class, SkillService::class);

        $this->app->bind(UploadStrategyInterface::class . '_portfolio', PortfolioUpload::class);
        $this->app->bind(UploadStrategyInterface::class . '_service', ServiceUpload::class);
        $this->app->bind(UploadStrategyInterface::class . '_project', ProjectUpload::class);
        $this->app->bind(UploadStrategyInterface::class . '_proposal', ProposalUpload::class);

        $this->app->bind(UploadStrategyFactory::class, function ($app) {
            return new UploadStrategyFactory(
                $app->make(UploadStrategyInterface::class . '_portfolio'),
                $app->make(UploadStrategyInterface::class . '_service'),
                $app->make(UploadStrategyInterface::class . '_project'),
                $app->make(UploadStrategyInterface::class . '_proposal'),
            );
        });

        $this->app->bind(SearchStrategyInterface::class . '_service', ServiceSearch::class);
        $this->app->bind(SearchStrategyInterface::class . '_project', ProjectSearch::class);

        $this->app->bind(SearchStrategyFactory::class, function ($app) {
            return new SearchStrategyFactory(
                $app->make(SearchStrategyInterface::class . '_service'),
                $app->make(SearchStrategyInterface::class . '_project')
            );
        });

        $this->app->bind(UserLanguageRepositoryInterface::class, UserLanguageRepository::class);


        $this->app->bind(LanguageRepositoryInterface::class, LanguageRepository::class);
        $this->app->bind(LanguageServiceInterface::class, LanguageService::class);


        $this->app->bind(UserVerificationRepositoryInterface::class, UserVerificationRepository::class);

        $this->app->bind(UserVerificationServiceInterface::class, UserVerificationService::class);

        $this->app->bind(InvitationFreelancerRepositoryInterface::class, InvitationFreelancerRepository::class);
        $this->app->bind(InvitationFreelancerServiceInterface::class, InvitationFreelancerService::class);

        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(ServiceServiceInterface::class, ServiceService::class);

        $this->app->bind(ServiceFaqRepositoryInterface::class, ServiceFaqRepository::class);

        $this->app->bind(CommissionRepositoryInterface::class, CommissionRepository::class);
        $this->app->bind(CommissionServiceInterface::class, CommissionService::class);

        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(ProjectServiceInterface::class, ProjectService::class);

        $this->app->bind(ProposalRepositoryInterface::class, ProposalRepository::class);
        $this->app->bind(ProposalAttachmentRepositoryInterface::class, ProposalAttachmentRepository::class);
        $this->app->bind(ProposalServiceInterface::class, ProposalService::class);

        $this->app->bind(HomeServiceInterface::class, HomeService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::automaticallyEagerLoadRelationships();

        Response::macro(
            'api',
            function ($message, $statusCode = 200, $status = true, $errorNum = null, $data = null) {
                $responseData = [
                    'status' => $status,
                    'error_num' => $errorNum,
                    'message' => $message,
                ];

                if ($data) {
                    if (is_object($data) && get_class($data) === 'App\Http\Resources\BaseResource') {
                        $resourceData = $data->toArray(request());

                        if (isset($resourceData['data']) && isset($resourceData['current_page']))
                            $responseData = array_merge($responseData, $resourceData);
                        else
                            $responseData['data'] = $resourceData;
                    } else {
                        $responseData['data'] = $data;
                    }
                }

                return response()->json($responseData, $statusCode);
            }
        );
    }
}
