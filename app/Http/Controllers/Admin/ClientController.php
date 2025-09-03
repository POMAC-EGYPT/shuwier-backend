<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Http\Resources\ClientResource;
use App\Services\Contracts\ClientServiceInterface;
use App\Traits\AuthorizesAdminActions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * @group Admin Client Management
 * 
 * APIs for managing clients in the admin panel.
 * These endpoints allow administrators to view and manage client accounts,
 * including listing all clients and viewing individual client details.
 */
class ClientController extends Controller
{
    use AuthorizesAdminActions;
    protected $clientService;

    public function __construct(ClientServiceInterface $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Display a listing of clients with optional filters.
     * 
     * This endpoint returns a paginated list of all clients in the system.
     * Results can be filtered by client name for easy searching.
     * The response includes pagination metadata for easy navigation.
     * 
     * @authenticated
     * @queryParam name string Optional filter by client name (searches in name). Example: سارة
     * @queryParam page integer Optional page number for pagination (default: 1). Example: 2
     * 
     * @response 200 scenario="Clients retrieved successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Clients retrieved successfully",
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "سارة",
     *       "email": "sara@example.com",
     *       "email_verified_at": "2025-08-24T10:30:00.000000Z",
     *       "phone": "+201234567890",
     *       "type": "client",
     *       "is_active": true,
     *       "about_me": "مديرة مشاريع تقنية",
     *       "profile_picture": null,
     *       "company": "شركة التقنيات المتقدمة",
     *       "created_at": "2025-08-24T10:30:00.000000Z",
     *       "updated_at": "2025-08-24T10:30:00.000000Z"
     *     },
     *     {
     *       "id": 2,
     *       "name": "محمد",
     *       "email": "mohamed@example.com",
     *       "email_verified_at": "2025-08-25T10:30:00.000000Z",
     *       "phone": "+201987654321",
     *       "type": "client",
     *       "is_active": true,
     *       "about_me": null,
     *       "profile_picture": null,
     *       "company": null,
     *       "created_at": "2025-08-25T10:30:00.000000Z",
     *       "updated_at": "2025-08-25T10:30:00.000000Z"
     *     }
     *   ],
     *   "current_page": 1,
     *   "from": 1,
     *   "last_page": 3,
     *   "per_page": 10,
     *   "to": 10,
     *   "total": 25,
     *   "links": {
     *     "first": "http://localhost/api/admin/clients?page=1",
     *     "last": "http://localhost/api/admin/clients?page=3",
     *     "prev": null,
     *     "next": "http://localhost/api/admin/clients?page=2"
     *   }
     * }
     *
     * @response 400 scenario="Validation error" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "The name field must be a string."
     * }
     *
     * @response 403 {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "You don't have permission to access this resource"
     * }
     *
     * @response 401 {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255'
        ]);

        if ($validator->fails())
            return Response::api($validator->errors()->first(), 400, false, 400);

        $result = $this->clientService->list(
            $request->name,
            10
        );

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(ClientResource::collection($result['data']))
        );
    }

    /**
     * Display the specified client details.
     * 
     * This endpoint returns detailed information about a specific client account.
     * Includes all client profile information and account status.
     * 
     * @authenticated
     * @urlParam id integer required The ID of the client to view. Example: 1
     * 
     * @response 200 scenario="Client details retrieved successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Client retrieved successfully",
     *   "data": {
     *     "id": 1,
     *     "name": "سارة أحمد",
     *     "email": "sara@example.com",
     *     "email_verified_at": "2025-08-24T10:30:00.000000Z",
     *     "phone": "+201234567890",
     *     "type": "client",
     *     "is_active": true,
     *     "about_me": "مديرة مشاريع تقنية مع خبرة 5 سنوات في إدارة فرق التطوير",
     *     "profile_picture": "https://example.com/storage/profiles/sara.jpg",
     *     "company": "شركة التقنيات المتقدمة",
     *     "created_at": "2025-08-24T10:30:00.000000Z",
     *     "updated_at": "2025-09-02T10:30:00.000000Z"
     *   }
     * }
     *
     * @response 404 {
     *   "status": false,
     *   "error_num": 404,
     *   "message": "Client not found"
     * }
     *
     * @response 403 {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "You don't have permission to access this resource"
     * }
     *
     * @response 401 {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    public function show(string $id)
    {
        $result = $this->clientService->getById((int) 
        $id);

        return Response::api(
            $result['message'],
            200,
            true,
            null,
            BaseResource::make(ClientResource::make($result['data']))
        );
    }

    /**
     * Delete a client account permanently.
     * 
     * This endpoint allows admins to permanently delete a client account from the system.
     * This action cannot be undone and will remove all associated data including profile information
     * and any project history. Use with caution as this is a destructive operation.
     * 
     * @authenticated
     * @urlParam id integer required The ID of the client to delete. Example: 5
     * 
     * @response 200 scenario="Client deleted successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Client deleted successfully"
     * }
     *
     * @response 404 {
     *   "status": false,
     *   "error_num": 404,
     *   "message": "Client not found"
     * }
     *
     * @response 400 scenario="Client has active projects" {
     *   "status": false,
     *   "error_num": 400,
     *   "message": "Cannot delete client with active projects"
     * }
     *
     * @response 403 {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "You don't have permission to access this resource"
     * }
     *
     * @response 401 {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    // public function destroy(string $id)
    // {
    //     $this->checkPermission('client.delete');
    //     $result = $this->clientService->delete($id);
    //     return Response::api($result['message'], 200, true, null);
    // }

    /**
     * Block or Unblock a client account.
     * 
     * This endpoint allows admins to toggle the active status of a client account.
     * When blocked (is_active = false), the client cannot log in or access the platform.
     * When unblocked (is_active = true), the client can resume normal platform activities.
     * This is a reversible action unlike deletion.
     * 
     * @authenticated
     * @urlParam id integer required The ID of the client to block/unblock. Example: 3
     * 
     * @response 200 scenario="Client blocked successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Client blocked successfully"
     * }
     *
     * @response 200 scenario="Client unblocked successfully" {
     *   "status": true,
     *   "error_num": null,
     *   "message": "Client unblocked successfully"
     * }
     *
     * @response 404 {
     *   "status": false,
     *   "error_num": 404,
     *   "message": "Client not found"
     * }
     *
     * @response 403 {
     *   "status": false,
     *   "error_num": 403,
     *   "message": "You don't have permission to access this resource"
     * }
     *
     * @response 401 {
     *   "status": false,
     *   "error_num": 401,
     *   "message": "Unauthenticated"
     * }
     */
    // public function blockAndUnblock(string $id)
    // {
    //     $this->checkPermission('client.blockAndUnblock');
    //     $result = $this->clientService->blockAndUnblock($id);
    //     return Response::api($result['message'], 200, true, null);
    // }
}
