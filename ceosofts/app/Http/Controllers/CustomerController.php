<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer; // ใช้ Model Customer สำหรับการจัดการข้อมูลในฐานข้อมูล

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * ฟังก์ชันนี้ดึงข้อมูลลูกค้าทั้งหมดจากฐานข้อมูล และส่งไปยัง View `customers.index`
     */
    public function index()
    {
        $customers = Customer::all(); // ดึงข้อมูลลูกค้าทั้งหมด
        return view('customers.index', compact('customers')); // ส่งข้อมูลไปยัง View
    }

    /**
     * Show the form for creating a new resource.
     * ฟังก์ชันนี้แสดงฟอร์มสำหรับเพิ่มลูกค้าใหม่
     */
    public function create()
    {
        return view('customers.create'); // แสดงหน้า View สำหรับสร้างลูกค้าใหม่
    }

    /**
     * Store a newly created resource in storage.
     * ฟังก์ชันนี้บันทึกข้อมูลลูกค้าใหม่ลงในฐานข้อมูลหลังจากการตรวจสอบข้อมูล (Validation)
     */
    public function store(Request $request)
    {
        // ตรวจสอบข้อมูลจากฟอร์ม
        $validated = $request->validate([
            'name' => 'required|string|max:255', // ชื่อจำเป็นและต้องเป็น string
            'email' => 'required|email|unique:customers', // อีเมลต้องไม่ซ้ำ
            'phone' => 'nullable|string|max:15', // เบอร์โทรศัพท์เป็นตัวเลือก
            'address' => 'nullable|string', // ที่อยู่เป็นตัวเลือก
            'taxid' => 'nullable|string|max:13', // เลขประจำตัวผู้เสียภาษีเป็นตัวเลือก
        ]);

        // บันทึกข้อมูลที่ผ่านการตรวจสอบลงฐานข้อมูล
        Customer::create($validated);

        // Redirect ไปยังหน้ารายการลูกค้าพร้อมข้อความสำเร็จ
        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     * ฟังก์ชันนี้แสดงข้อมูลรายละเอียดของลูกค้าตาม ID ที่ระบุ
     */
    public function show(string $id)
    {
        $customer = Customer::findOrFail($id); // ดึงข้อมูลลูกค้าด้วย ID
        return view('customers.show', compact('customer')); // ส่งข้อมูลไปยัง View
    }

    /**
     * Show the form for editing the specified resource.
     * ฟังก์ชันนี้แสดงฟอร์มสำหรับแก้ไขข้อมูลลูกค้าตาม ID ที่ระบุ
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id); // ดึงข้อมูลลูกค้าด้วย ID
        return view('customers.edit', compact('customer')); // ส่งข้อมูลไปยัง View
    }

    /**
     * Update the specified resource in storage.
     * ฟังก์ชันนี้อัปเดตข้อมูลลูกค้าในฐานข้อมูลหลังจากการตรวจสอบข้อมูล (Validation)
     */
    public function update(Request $request, string $id)
    {
        // ตรวจสอบข้อมูลจากฟอร์ม
        $validated = $request->validate([
            'name' => 'required|string|max:255', // ชื่อจำเป็น
            'email' => 'required|email|unique:customers,email,' . $id, // อีเมลต้องไม่ซ้ำ ยกเว้นของตัวเอง
            'phone' => 'nullable|string|max:15', // เบอร์โทรศัพท์เป็นตัวเลือก
            'address' => 'nullable|string', // ที่อยู่เป็นตัวเลือก
            'taxid' => 'nullable|string|max:13', // เลขประจำตัวผู้เสียภาษีเป็นตัวเลือก
        ]);

        $customer = Customer::findOrFail($id); // ดึงข้อมูลลูกค้าด้วย ID
        $customer->update($validated); // อัปเดตข้อมูลที่ผ่านการตรวจสอบ

        // Redirect ไปยังหน้ารายการลูกค้าพร้อมข้อความสำเร็จ
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * ฟังก์ชันนี้ลบข้อมูลลูกค้าออกจากฐานข้อมูลตาม ID ที่ระบุ
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id); // ดึงข้อมูลลูกค้าด้วย ID
        $customer->delete(); // ลบข้อมูลลูกค้าออกจากฐานข้อมูล

        // Redirect ไปยังหน้ารายการลูกค้าพร้อมข้อความสำเร็จ
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
