<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
   use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\CmsBanner;
   use Illuminate\Support\Facades\File;
   use Intervention\Image\Drivers\Gd\Driver as GdDriver;
   use Intervention\Image\ImageManager;

class CMSController extends Controller
{
    public function index()
    {
        $banners = CmsBanner::firstOrCreate([]);

        return view('SuperAdmin.cms', compact('banners'));
    }

    public function editBanners()
    {
        $banners = CmsBanner::firstOrCreate([]);

        return view('SuperAdmin.cms-banner-edit', compact('banners'));
    }

    public function updateBanners(Request $request)
    {
        $banners = CmsBanner::firstOrCreate([]);

        $data = $request->validate([
            'image1' => ['nullable', 'image', 'max:5120', 'dimensions:width=1400,height=600'],
            'image2' => ['nullable', 'image', 'max:5120', 'dimensions:width=1400,height=600'],
            'image3' => ['nullable', 'image', 'max:5120', 'dimensions:width=1400,height=600'],
            'mob_img1' => ['nullable', 'image', 'max:5120', 'dimensions:width=768,height=1000'],
            'mob_img2' => ['nullable', 'image', 'max:5120', 'dimensions:width=768,height=1000'],
            'mob_img3' => ['nullable', 'image', 'max:5120', 'dimensions:width=768,height=1000'],
        ]);

        foreach ([1, 2, 3] as $image) {
            if ($request->hasFile('image' . $image)) {
                $file = $request->file('image' . $image);
                $directory = public_path('front_assets/img/cms');
                File::ensureDirectoryExists($directory);

                $filename = 'image' . $image . '.jpg';
                $path = $directory . DIRECTORY_SEPARATOR . $filename;
                $manager = new ImageManager(new GdDriver());
                $manager->read($file->getPathname())
                    ->resize(1400, 600)
                    ->toJpeg(90)
                    ->save($path);

                $data['image' . $image] = 'front_assets/img/cms/' . $filename;
            } else {
                unset($data['image' . $image]);
            }
        }

        foreach ([1, 2, 3] as $image) {
            $field = 'mob_img' . $image;

            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $directory = public_path('front_assets/img/cms');
                File::ensureDirectoryExists($directory);

                $filename = $field . '.jpg';
                $path = $directory . DIRECTORY_SEPARATOR . $filename;
                $manager = new ImageManager(new GdDriver());
                $manager->read($file->getPathname())
                    ->resize(768, 1000)
                    ->toJpeg(90)
                    ->save($path);

                $data[$field] = 'front_assets/img/cms/' . $filename;
            } else {
                unset($data[$field]);
            }
        }

        $banners->update($data);

        return redirect()->route('superadmin.cms.home.edit')->with('success', 'Banner updated successfully.');
    }

    public function dashboard()
    {
        $banners = CmsBanner::firstOrCreate([]);

        return view('SuperAdmin.cms.dashboard.index', compact('banners'));
    }

    public function editDashboard()
    {
        $banners = CmsBanner::firstOrCreate([]);

        return view('SuperAdmin.cms.dashboard.edit', compact('banners'));
    }

    public function updateDashboard(Request $request)
    {
        $banners = CmsBanner::firstOrCreate([]);

        $data = $request->validate([
            'dashboard_image' => ['nullable', 'image', 'max:5120'],
        ]);

        if ($request->hasFile('dashboard_image')) {
            $file = $request->file('dashboard_image');
            $directory = public_path('front_assets/img/cms');
            File::ensureDirectoryExists($directory);

            $filename = 'dashboard.jpg';
            $path = $directory . DIRECTORY_SEPARATOR . $filename;

            $manager = new ImageManager(new GdDriver());
            $manager->read($file->getPathname())
                ->toJpeg(90)
                ->save($path);

            $data['dashboard_image'] = 'front_assets/img/cms/' . $filename;
        } else {
            unset($data['dashboard_image']);
        }

        $banners->update($data);

        return redirect()->route('superadmin.cms.dashboard')
            ->with('success', 'Dashboard image updated successfully.');
    }

    public function editHomeBenefits()
    {
        $banners = CmsBanner::firstOrCreate([]);

        return view('SuperAdmin.cms.home-benefits-edit', compact('banners'));
    }

    public function updateHomeBenefits(Request $request)
    {
        $data = $request->validate([
            'benefit_h1' => ['nullable', 'string', 'max:255'],
            'benefit_t1' => ['nullable', 'string', 'max:2000'],
            'benefit_h2' => ['nullable', 'string', 'max:255'],
            'benefit_t2' => ['nullable', 'string', 'max:2000'],
            'benefit_h3' => ['nullable', 'string', 'max:255'],
            'benefit_t3' => ['nullable', 'string', 'max:2000'],
            'benefit_h4' => ['nullable', 'string', 'max:255'],
            'benefit_t4' => ['nullable', 'string', 'max:2000'],
            'benefit_stat1_value' => ['nullable', 'string', 'max:100'],
            'benefit_stat1_label' => ['nullable', 'string', 'max:255'],
            'benefit_stat2_value' => ['nullable', 'string', 'max:100'],
            'benefit_stat2_label' => ['nullable', 'string', 'max:255'],
            'benefit_stat3_value' => ['nullable', 'string', 'max:100'],
            'benefit_stat3_label' => ['nullable', 'string', 'max:255'],
        ]);

        CmsBanner::firstOrCreate([])->update($data);

        return redirect()->route('superadmin.cms.home.benefits.edit')
            ->with('success', 'Home benefits updated successfully.');
    }

    public function editAiTools()
    {
        $banners = CmsBanner::firstOrCreate([]);

        return view('SuperAdmin.cms.ai-tools.edit', compact('banners'));
    }

    public function updateAiTools(Request $request)
    {
        $data = $request->validate([
            'ai_tools_title' => ['required', 'string', 'max:255'],
            'ai_tools_content' => ['required', 'string'],
        ]);

        CmsBanner::firstOrCreate([])->update($data);

        return redirect()->route('superadmin.cms.ai-tools.edit')
            ->with('success', 'AI Tools section updated successfully.');
    }

    // public function createAdmin()
    // {
    //     $users = User::where('role', 'admin')->get();
    //     // dd($users);
    //     return view('UserManagement/users', compact('users'));

    // }
    public function createAdmin()
    {
        $users = \App\Models\Admin::all();
        $states = [
            'Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa', 'Gujarat',
            'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 'Madhya Pradesh',
            'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab',
            'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 'Uttar Pradesh',
            'Uttarakhand', 'West Bengal', 'Andaman and Nicobar Islands', 'Chandigarh',
            'Dadra and Nagar Haveli and Daman and Diu', 'Delhi', 'Jammu and Kashmir',
            'Ladakh', 'Lakshadweep', 'Puducherry'
        ];
        return view('UserManagement/users', compact('users', 'states'));
    }

    public function storeAdmin(Request $request, \App\Services\TenantService $tenantService)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username',
            'email' => 'required|email|unique:admins,email',
            'phone' => 'required|string|max:15',
            'password' => 'required|min:6|confirmed',
            'status' => 'required|in:active,inactive',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'pincode' => 'nullable|string',
        ]);

        $admin = \App\Models\Admin::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'status' => $request->status,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'is_verified' => true, // Automatically verify admins created by Super Admin
        ]);

        try {
            $dbName = $tenantService->createTenant($admin);
            $admin->update(['db_name' => $dbName]);
        } catch (\Exception $e) {
            // Optionally handle cleanup if DB creation fails
            return redirect()->back()->with('error', 'Admin created but database setup failed: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Admin added and database initialized successfully.');
    }
    public function updateAdmin(Request $request, $id)
    {
        // dd( $request);
        $admin = \App\Models\Admin::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,
            'phone' => 'required|string|max:15',
            'status' => 'required|in:active,inactive',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'pincode' => 'nullable|string',
            'password' => 'nullable|min:6', // Password optional on update
        ]);
// dd($request->address);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
        ];

        if ($request->filled('password')) {
            $data['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->back()->with('success', 'Admin updated successfully.');
    }


public function destroyAdmin($id)
{
    $admin = \App\Models\Admin::findOrFail($id);

    try {
        DB::beginTransaction();

        // Store database name before deleting admin
        $dbName = $admin->db_name;

        // Delete admin record
        $admin->delete();

        // Drop tenant database
        if (!empty($dbName)) {
            DB::statement("DROP DATABASE IF EXISTS `{$dbName}`");
        }

        DB::commit();

        return redirect()->back()->with('success', 'Admin and tenant database deleted successfully.');

    } catch (\Exception $e) {

        DB::rollBack();

        Log::error('Failed to delete admin', [
            'admin_id' => $id,
            'database' => $admin->db_name,
            'error' => $e->getMessage(),
        ]);

        return redirect()->back()->with('error', 'Failed to delete admin: '.$e->getMessage());
    }
}

    public function settings()
    {
        return view('Settings/settings');
    }
}
