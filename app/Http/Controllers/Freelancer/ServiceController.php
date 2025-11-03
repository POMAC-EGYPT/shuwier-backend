<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Freelancer\Service\StoreServiceRequest;
use App\Http\Requests\Freelancer\Service\UpdateServiceRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\ServiceResource;
use App\Services\Contracts\ServiceServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * @group Service Management
 * 
 * APIs for managing freelancer services - creating, listing, updating and managing service offerings
 */
class ServiceController extends Controller
{
    protected $serviceService;

    public function __construct(ServiceServiceInterface $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    /**
     * Get freelancer services
     * 
     * Retrieve all services created by the authenticated freelancer with pagination.
     * This endpoint returns a paginated list of the freelancer's service offerings including
     * title, description, pricing, delivery time, and other service details.
     * 
     * @authenticated
     * 
     * @queryParam per_page integer Number of services per page (minimum 1). Default is 10. Example: 15
     * 
     * @response 200 scenario="Services retrieved successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": [
     *     {
     *       "id": 1,
     *       "title": "WordPress Website Development",
     *       "description": "I will create a professional WordPress website with custom design and functionality",
     *       "category_id": 4,
     *       "subcategory_id": 5,
     *       "delivery_time": 7,
     *       "delivery_time_unit": "days",
     *       "service_fees_type": "fixed",
     *       "price": "500.00",
     *       "cover_photo": "storage/services/68d3dfbf590a6.PNG",
     *       "faqs": [
     *         {
     *           "id": 1,
     *           "question": "Do you provide hosting?",
     *           "answer": "No, you need to provide your own hosting.",
     *           "service_id": 1,
     *           "created_at": "2025-09-24T12:10:39.000000Z",
     *           "updated_at": "2025-09-24T12:10:39.000000Z"
     *         }
     *       ],
     *       "attachments": [
     *         {
     *           "id": 1,
     *           "file_path": "storage/services/68d3df744e841.PNG",
     *           "user_id": 3,
     *           "service_id": 1,
     *           "created_at": "2025-09-24T12:09:24.000000Z",
     *           "updated_at": "2025-09-24T12:10:39.000000Z"
     *         }
     *       ],
     *       "hashtags": [
     *         {
     *           "id": 11,
     *           "name": "wordpress",
     *           "created_at": "2025-09-24T12:10:39.000000Z",
     *           "updated_at": "2025-09-24T12:10:39.000000Z",
     *           "pivot": {
     *             "service_id": 1,
     *             "hashtag_id": 11
     *           }
     *         }
     *       ],
     *       "user_id": 3,
     *       "created_at": "2025-09-24T12:10:39.000000Z",
     *       "updated_at": "2025-09-24T12:10:39.000000Z"
     *     }
     *   ],
     *   "current_page": 1,
     *   "from": 1,
     *   "last_page": 1,
     *   "per_page": 10,
     *   "to": 4,
     *   "total": 4,
     *   "links": {
     *     "first": "http://127.0.0.1:8000/api/freelancers/services?page=1",
     *     "last": "http://127.0.0.1:8000/api/freelancers/services?page=1",
     *     "prev": null,
     *     "next": null
     *   }
     * }
     * 
     * @response 200 scenario="No services found" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": [],
     *   "current_page": 1,
     *   "from": null,
     *   "last_page": 1,
     *   "per_page": 10,
     *   "to": null,
     *   "total": 0,
     *   "links": {
     *     "first": "http://127.0.0.1:8000/api/freelancers/services?page=1",
     *     "last": "http://127.0.0.1:8000/api/freelancers/services?page=1",
     *     "prev": null,
     *     "next": null
     *   }
     * }
     * 
     * @response 400 scenario="Invalid per_page parameter" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The per page must be at least 1."
     * }
     * 
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'per_page' => 'sometimes|integer|min:1'
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->serviceService->getByFreelancerIdPaginated(auth('api')->id(), $request->per_page ?? 10);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null, BaseResource::make(ServiceResource::collection($result['data'])));
    }


    /**
     * Create new service
     * 
     * Create a new service offering for the authenticated freelancer. This endpoint allows
     * freelancers to add new services to their profile with detailed information including
     * pricing, delivery time, cover photo, attachments, FAQs, and hashtags.
     * 
     * @authenticated
     * 
     * @bodyParam title string required Service title (max 255 characters). Example: WordPress Website Development
     * @bodyParam description string required Detailed service description. Example: I will create a professional WordPress website with custom design and functionality
     * @bodyParam category_id integer required Main category ID (must be a parent category). Example: 1
     * @bodyParam subcategory_id integer optional Subcategory ID (must belong to the selected category). Example: 4
     * @bodyParam delivery_time_unit string required Time unit for delivery. Must be one of: hours, days, months. Example: days
     * @bodyParam delivery_time integer required Delivery time in the specified unit. Example: 7
     * @bodyParam service_fees_type string required Pricing type. Must be one of: fixed, hourly. Example: fixed
     * @bodyParam price number required Service price (minimum 0). Example: 500.00
     * @bodyParam cover_photo file required Cover photo for the service (image file, max 2MB). Example: No-example
     * @bodyParam hashtags string[] optional Array of hashtag strings (max 255 characters each). Example: ["wordpress", "website", "development"]
     * @bodyParam attachment_ids integer[] optional Array of attachment IDs from uploaded files. Upload files first using /api/upload endpoint. Example: [15, 16, 17]
     * @bodyParam faqs object[] optional Array of FAQ objects with question and answer. Example: No-example
     * @bodyParam faqs.*.question string required_with:faqs FAQ question (max 500 characters). Example: Do you provide hosting?
     * @bodyParam faqs.*.answer string required_with:faqs FAQ answer (max 1000 characters). Example: No, you need to provide your own hosting.
     * 
     * @response 200 scenario="Service created successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Service created successfully",
     *   "data": {
     *     "id": 29,
     *     "title": "WordPress Website Development",
     *     "description": "I will create a professional WordPress website with custom design and functionality",
     *     "category_id": 4,
     *     "subcategory_id": 5,
     *     "category": {
     *       "id": 4,
     *       "name": "Programming",
     *       "parent_id": null,
     *       "created_at": "2025-09-07T08:44:46.000000Z",
     *       "updated_at": "2025-09-07T08:44:46.000000Z"
     *     },
     *     "subcategory": {
     *       "id": 5,
     *       "name": "Web",
     *       "parent_id": 4,
     *       "created_at": "2025-09-07T08:44:46.000000Z",
     *       "updated_at": "2025-09-07T08:44:46.000000Z"
     *     },
     *     "delivery_time": 7,
     *     "delivery_time_unit": "days",
     *     "service_fees_type": "fixed",
     *     "price": "500.00",
     *     "cover_photo": "storage/services/68d3dfbf590a6.PNG",
     *     "faqs": [
     *       {
     *         "id": 15,
     *         "question": "Do you provide hosting?",
     *         "answer": "No, you need to provide your own hosting.",
     *         "service_id": 29,
     *         "created_at": "2025-09-24T10:00:00.000000Z",
     *         "updated_at": "2025-09-24T10:00:00.000000Z"
     *       }
     *     ],
     *     "attachments": [
     *       {
     *         "id": 15,
     *         "file_path": "storage/services/68d3df744e841.PNG",
     *         "user_id": 3,
     *         "service_id": 29,
     *         "created_at": "2025-09-24T10:00:00.000000Z",
     *         "updated_at": "2025-09-24T10:00:00.000000Z"
     *       }
     *     ],
     *     "hashtags": [
     *       {
     *         "id": 11,
     *         "name": "wordpress",
     *         "created_at": "2025-09-24T10:00:00.000000Z",
     *         "updated_at": "2025-09-24T10:00:00.000000Z",
     *         "pivot": {
     *           "service_id": 29,
     *           "hashtag_id": 11
     *         }
     *       }
     *     ],
     *     "user_id": 3,
     *     "created_at": "2025-09-24T10:00:00.000000Z",
     *     "updated_at": "2025-09-24T10:00:00.000000Z"
     *   }
     * }
     * 
     * @response 400 scenario="Invalid category" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "This category is not a parent category"
     * }
     * 
     * @response 400 scenario="Invalid subcategory" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "This subcategory does not belong to the selected category"
     * }
     * 
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     * 
     * @response 400 scenario="Validation error" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The title field is required."
     * }
     */
    public function store(StoreServiceRequest $request)
    {
        $result = $this->serviceService->create([
            'title'              => $request->title,
            'description'        => $request->description,
            'category_id'        => $request->category_id,
            'subcategory_id'     => $request->subcategory_id ?? null,
            'delivery_time_unit' => $request->delivery_time_unit,
            'delivery_time'      => $request->delivery_time,
            'service_fees_type'  => $request->service_fees_type,
            'price'              => $request->price,
            'cover_photo'        => $request->cover_photo,
            'hashtags'           => $request->hashtags ?? [],
            'attachment_ids'     => $request->attachment_ids ?? [],
            'faqs'               => $request->faqs ?? [],
            'user_id'            => auth('api')->id(),
        ]);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null, BaseResource::make(ServiceResource::make($result['data'])));
    }

    /**
     * Get specific service
     * 
     * Retrieve detailed information about a specific service by its ID. This endpoint returns
     * comprehensive service details including all related data like category, subcategory,
     * attachments, FAQs, hashtags, and pricing information.
     * 
     * @authenticated
     * 
     * @urlParam id integer required The service ID to retrieve. Example: 1
     * 
     * @response 200 scenario="Service retrieved successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Success",
     *   "data": {
     *     "id": 1,
     *     "title": "WordPress Website Development",
     *     "description": "I will create a professional WordPress website with custom design and functionality tailored to your business needs",
     *     "category_id": 4,
     *     "subcategory_id": 5,
     *     "category": {
     *       "id": 4,
     *       "name": "Programming",
     *       "parent_id": null,
     *       "created_at": "2025-09-07T08:44:46.000000Z",
     *       "updated_at": "2025-09-07T08:44:46.000000Z"
     *     },
     *     "subcategory": {
     *       "id": 5,
     *       "name": "Web",
     *       "parent_id": 4,
     *       "created_at": "2025-09-07T08:44:46.000000Z",
     *       "updated_at": "2025-09-07T08:44:46.000000Z"
     *     },
     *     "delivery_time": 7,
     *     "delivery_time_unit": "days",
     *     "service_fees_type": "fixed",
     *     "price": "500.00",
     *     "cover_photo": "storage/services/68d3dfbf590a6.PNG",
     *     "faqs": [
     *       {
     *         "id": 1,
     *         "question": "Do you provide hosting?",
     *         "answer": "No, you need to provide your own hosting. However, I can recommend reliable hosting providers.",
     *         "service_id": 1,
     *         "created_at": "2025-09-24T12:10:39.000000Z",
     *         "updated_at": "2025-09-24T12:10:39.000000Z"
     *       },
     *       {
     *         "id": 2,
     *         "question": "How many revisions are included?",
     *         "answer": "I provide up to 3 revisions to ensure you're completely satisfied with the final result.",
     *         "service_id": 1,
     *         "created_at": "2025-09-24T12:10:39.000000Z",
     *         "updated_at": "2025-09-24T12:10:39.000000Z"
     *       }
     *     ],
     *     "attachments": [
     *       {
     *         "id": 1,
     *         "file_path": "storage/services/68d3df744e841.PNG",
     *         "user_id": 3,
     *         "service_id": 1,
     *         "created_at": "2025-09-24T12:09:24.000000Z",
     *         "updated_at": "2025-09-24T12:10:39.000000Z"
     *       }
     *     ],
     *     "hashtags": [
     *       {
     *         "id": 11,
     *         "name": "wordpress",
     *         "created_at": "2025-09-24T12:10:39.000000Z",
     *         "updated_at": "2025-09-24T12:10:39.000000Z",
     *         "pivot": {
     *           "service_id": 1,
     *           "hashtag_id": 11
     *         }
     *       }
     *     ],
     *     "user_id": 3,
     *     "created_at": "2025-09-24T12:10:39.000000Z",
     *     "updated_at": "2025-09-24T12:10:39.000000Z"
     *   }
     * }
     * 
     * @response 400 scenario="Service not found" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Service not found"
     * }
     * 
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     * 
     * @response 403 scenario="Access denied - Not your service" {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "You don't have permission to access this service"
     * }
     */
    public function show(string $id)
    {
        $result = $this->serviceService->findByIdAndFreelancerId($id, auth('api')->id());

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null, BaseResource::make(ServiceResource::make($result['data'])));
    }

    /**
     * Update service
     * 
     * Update an existing service offering for the authenticated freelancer. This endpoint allows
     * freelancers to modify their service information including pricing, delivery time, cover photo,
     * attachments, FAQs, and hashtags. All fields are optional except the service ID in the URL.
     * 
     * @authenticated
     * 
     * @urlParam id integer required Service ID to update. Example: 1
     * 
     * @bodyParam title string optional Service title (max 255 characters). Example: Updated WordPress Website Development
     * @bodyParam description string optional Detailed service description (min 200 characters). Example: I will create a professional WordPress website with advanced features and custom functionality
     * @bodyParam category_id integer optional Main category ID (must be a parent category). Example: 4
     * @bodyParam subcategory_id integer optional Subcategory ID (must belong to the selected category). Example: 5
     * @bodyParam delivery_time_unit string optional Time unit for delivery. Must be one of: hours, days, months. Example: days
     * @bodyParam delivery_time integer optional Delivery time in the specified unit. Example: 10
     * @bodyParam service_fees_type string optional Pricing type. Must be one of: fixed, hourly. Example: fixed
     * @bodyParam price number optional Service price (minimum 0). Example: 750.00
     * @bodyParam cover_photo file optional New cover photo for the service (image file, max 2MB). Example: No-example
     * @bodyParam hashtags string[] optional Array of hashtag strings (max 255 characters each). Example: ["wordpress", "website", "ecommerce", "responsive"]
     * @bodyParam attachment_ids integer[] optional Array of attachment IDs from uploaded files. Upload files first using /api/upload endpoint. Example: [18, 19, 20]
     * @bodyParam faqs object[] optional Array of FAQ objects with question and answer. Example: No-example
     * @bodyParam faqs.*.question string required_with:faqs FAQ question (max 500 characters). Example: Do you provide SSL certificates?
     * @bodyParam faqs.*.answer string required_with:faqs FAQ answer (max 1000 characters). Example: Yes, I can help you install SSL certificates for enhanced security.
     * 
     * @response 200 scenario="Service updated successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Service updated successfully",
     *   "data": {
     *     "id": 1,
     *     "title": "Updated WordPress Website Development",
     *     "description": "I will create a professional WordPress website with advanced features and custom functionality tailored to your business needs",
     *     "category_id": 4,
     *     "subcategory_id": 5,
     *     "category": {
     *       "id": 4,
     *       "name": "Programming",
     *       "parent_id": null,
     *       "created_at": "2025-09-07T08:44:46.000000Z",
     *       "updated_at": "2025-09-07T08:44:46.000000Z"
     *     },
     *     "subcategory": {
     *       "id": 5,
     *       "name": "Web",
     *       "parent_id": 4,
     *       "created_at": "2025-09-07T08:44:46.000000Z",
     *       "updated_at": "2025-09-07T08:44:46.000000Z"
     *     },
     *     "delivery_time": 10,
     *     "delivery_time_unit": "days",
     *     "service_fees_type": "fixed",
     *     "price": "750.00",
     *     "cover_photo": "storage/services/68d3dfbf590a6.PNG",
     *     "faqs": [
     *       {
     *         "id": 1,
     *         "question": "Do you provide SSL certificates?",
     *         "answer": "Yes, I can help you install SSL certificates for enhanced security.",
     *         "service_id": 1,
     *         "created_at": "2025-09-24T15:30:00.000000Z",
     *         "updated_at": "2025-09-24T15:30:00.000000Z"
     *       }
     *     ],
     *     "attachments": [
     *       {
     *         "id": 18,
     *         "file_path": "storage/services/68d3df744e841.PNG",
     *         "user_id": 3,
     *         "service_id": 1,
     *         "created_at": "2025-09-24T15:30:00.000000Z",
     *         "updated_at": "2025-09-24T15:30:00.000000Z"
     *       }
     *     ],
     *     "hashtags": [
     *       {
     *         "id": 11,
     *         "name": "wordpress",
     *         "created_at": "2025-09-24T15:30:00.000000Z",
     *         "updated_at": "2025-09-24T15:30:00.000000Z",
     *         "pivot": {
     *           "service_id": 1,
     *           "hashtag_id": 11
     *         }
     *       }
     *     ],
     *     "user_id": 3,
     *     "created_at": "2025-09-24T12:10:39.000000Z",
     *     "updated_at": "2025-09-24T15:30:00.000000Z"
     *   }
     * }
     * 
     * @response 400 scenario="Invalid category" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "This category is not a parent category"
     * }
     * 
     * @response 400 scenario="Invalid subcategory" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "This subcategory does not belong to the selected category"
     * }
     * 
     * @response 400 scenario="Attachment already used" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "This attachment is already used"
     * }
     * 
     * @response 404 scenario="Service not found" {
     *   "status": false,
     *   "error_num": 404,
     *   "message": "Service not found"
     * }
     * 
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     * 
     * @response 400 scenario="Validation error" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The title field must not be greater than 255 characters."
     * }
     */
    public function update(UpdateServiceRequest $request, string $id)
    {
        $result = $this->serviceService->update($id, auth('api')->id(), [
            'title'              => $request->title,
            'description'        => $request->description,
            'category_id'        => $request->category_id,
            'subcategory_id'     => $request->subcategory_id ?? null,
            'delivery_time_unit' => $request->delivery_time_unit,
            'delivery_time'      => $request->delivery_time,
            'service_fees_type'  => $request->service_fees_type,
            'price'              => $request->price,
            'cover_photo'        => $request->cover_photo ?? null,
            'hashtags'           => $request->hashtags ?? null,
            'attachment_ids'     => $request->attachment_ids ?? null,
            'faqs'               => $request->faqs ?? null,
        ]);

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true, null, BaseResource::make(ServiceResource::make($result['data'])));
    }

    /**
     * Delete service
     * 
     * Delete an existing service offering for the authenticated freelancer. This endpoint
     * permanently removes the service and all associated data including FAQs, hashtag
     * associations, and attachment references. The service attachments files will also
     * be deleted from storage.
     * 
     * @authenticated
     * 
     * @urlParam id integer required Service ID to delete. Example: 1
     * 
     * @response 200 scenario="Service deleted successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Service deleted successfully"
     * }
     * 
     * @response 404 scenario="Service not found" {
     *   "status": false,
     *   "error_num": 404,
     *   "message": "Service not found"
     * }
     * 
     * @response 401 scenario="Unauthenticated" {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     * 
     * @response 403 scenario="Unauthorized access" {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "You are not authorized to delete this service"
     * }
     */
    public function destroy(string $id)
    {
        $result = $this->serviceService->delete($id, auth('api')->id());

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['message'], 200, true);
    }
}
