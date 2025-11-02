<?php

namespace App\Http\Controllers;

use App\Enum\UserType;
use App\Http\Resources\ClientResource;
use App\Http\Resources\FreelancerResource;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProfileController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get User Profile.
     * 
     * @group Profile Management
     * 
     * This endpoint retrieves the authenticated user's profile information.
     * Returns different data structures based on user type (freelancer or client).
     * Freelancers will get additional fields like skills, category, portfolio links, etc.
     * Clients will get basic profile information along with company details.
     * 
     * @response 200 scenario="Freelancer profile" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Profile retrieved successfully",
     *   "data": {
     *     "id": 1,
     *     "name": "أحمد محمد",
     *     "email": "ahmed@example.com",
     *     "type": "freelancer",
     *     "email_verified_at": "2025-08-24T10:30:00.000000Z",
     *     "phone": null,
     *     "is_active": true,
     *     "about_me": "مطور ويب محترف مع خبرة 5 سنوات",
     *     "profile_picture": "storage/profiles/ahmed_profile.jpg",
     *     "approval_status": "approved",
     *     "other_links": ["https://upwork.com/freelancers/ahmed"],
     *     "portfolio_link": "https://ahmed-portfolio.com",
     *     "headline": "Full Stack Developer & UI/UX Designer",
     *     "description": "Experienced developer specializing in Laravel and React",
     *     "category": {
     *       "id": 1,
     *       "name": "Web Development"
     *     },
     *     "skills": [
     *       {"id": 1, "name": "PHP"},
     *       {"id": 2, "name": "Laravel"},
     *       {"id": 3, "name": "React"}
     *     ],
     *     "portfolios": [],
     *     "created_at": "2025-08-24T10:30:00.000000Z",
     *     "updated_at": "2025-08-24T10:30:00.000000Z"
     *   }
     * }
     *
     * @response 200 scenario="Client profile" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Profile retrieved successfully",
     *   "data": {
     *     "id": 2,
     *     "name": "Jane Smith",
     *     "email": "jane@example.com",
     *     "email_verified_at": "2025-08-24T10:30:00.000000Z",
     *     "phone": "+1234567890",
     *     "type": "client",
     *     "is_active": true,
     *     "about_me": "Business owner looking for quality freelance services",
     *     "profile_picture": "storage/profiles/jane_profile.jpg",
     *     "company": "Tech Solutions Inc",
     *     "created_at": "2025-08-24T10:30:00.000000Z",
     *     "updated_at": "2025-08-24T10:30:00.000000Z"
     *   }
     * }
     *
     *
     * @response 400 scenario="Profile retrieval failed" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Unable to retrieve profile information"
     * }
     */
    public function profile(string $username)
    {
        $result = $this->userService->getProfile($username);

        if (!$result['status'])
            return Response::api($result['message'], $result['error_num'], false, $result['error_num']);

        $user = $result['data'];

        $resource = $user->type == UserType::FREELANCER->value
            ? FreelancerResource::make($user)
            : ClientResource::make($user);

        return Response::api($result['message'], 200, true, null, $resource);
    }
}
