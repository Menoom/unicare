<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Static doctor data matching dashboard cards.
     */
    private function getDoctors(): array
    {
        return [
            1 => [
                'id' => 1,
                'name' => 'Dr. Sarah Mitchell',
                'specialty' => 'Cardiologist',
                'practice' => 'Hospital',
                'practice_key' => 'hospital',
                'gender' => 'Female',
                'availability' => 'available',
                'fee' => 800,
                'experience' => 12,
                'education' => 'MBBS, MD (Cardiology) — AIIMS Delhi',
                'languages' => ['English', 'Hindi'],
                'about' => 'Dr. Sarah Mitchell is a renowned cardiologist with over 12 years of experience in diagnosing and treating heart diseases. She specialises in interventional cardiology, echocardiography, and preventive cardiac care.',
                'slots' => [
                    ['time' => '10:00 AM', 'booked' => false],
                    ['time' => '10:30 AM', 'booked' => false],
                    ['time' => '11:00 AM', 'booked' => true],
                    ['time' => '11:30 AM', 'booked' => false],
                    ['time' => '2:00 PM', 'booked' => false],
                    ['time' => '2:30 PM', 'booked' => true],
                    ['time' => '3:00 PM', 'booked' => false],
                    ['time' => '4:30 PM', 'booked' => true],
                ],
            ],
            2 => [
                'id' => 2,
                'name' => 'Dr. James Patel',
                'specialty' => 'Dermatologist',
                'practice' => 'Private Clinic',
                'practice_key' => 'private',
                'gender' => 'Male',
                'availability' => 'available',
                'fee' => 600,
                'experience' => 8,
                'education' => 'MBBS, MD (Dermatology) — KEM Mumbai',
                'languages' => ['English', 'Hindi', 'Gujarati'],
                'about' => 'Dr. James Patel is a skilled dermatologist with 8 years of expertise in treating skin, hair, and nail disorders. He has a special interest in cosmetic dermatology and laser treatments.',
                'slots' => [
                    ['time' => '9:00 AM', 'booked' => false],
                    ['time' => '9:30 AM', 'booked' => false],
                    ['time' => '10:00 AM', 'booked' => false],
                    ['time' => '11:30 AM', 'booked' => false],
                    ['time' => '3:00 PM', 'booked' => false],
                    ['time' => '3:30 PM', 'booked' => true],
                    ['time' => '4:00 PM', 'booked' => false],
                ],
            ],
            3 => [
                'id' => 3,
                'name' => 'Dr. Priya Sharma',
                'specialty' => 'Pediatrician',
                'practice' => 'Hospital',
                'practice_key' => 'hospital',
                'gender' => 'Female',
                'availability' => 'fully-booked',
                'fee' => 700,
                'experience' => 15,
                'education' => 'MBBS, DCH (Pediatrics) — CMC Vellore',
                'languages' => ['English', 'Hindi', 'Tamil'],
                'about' => 'Dr. Priya Sharma is an experienced pediatrician with 15 years in child healthcare. She focuses on neonatal care, childhood vaccinations, and developmental pediatrics.',
                'slots' => [
                    ['time' => '9:30 AM', 'booked' => true],
                    ['time' => '10:00 AM', 'booked' => true],
                    ['time' => '10:30 AM', 'booked' => true],
                    ['time' => '1:00 PM', 'booked' => true],
                    ['time' => '1:30 PM', 'booked' => true],
                    ['time' => '5:00 PM', 'booked' => true],
                ],
            ],
            4 => [
                'id' => 4,
                'name' => 'Dr. Arjun Reddy',
                'specialty' => 'Orthopedic Surgeon',
                'practice' => 'Hospital',
                'practice_key' => 'hospital',
                'gender' => 'Male',
                'availability' => 'available',
                'fee' => 1000,
                'experience' => 10,
                'education' => 'MBBS, MS (Orthopedics) — JIPMER',
                'languages' => ['English', 'Hindi', 'Telugu'],
                'about' => 'Dr. Arjun Reddy is a skilled orthopedic surgeon with 10 years of experience in joint replacements, sports injuries, and spine surgeries.',
                'slots' => [
                    ['time' => '8:00 AM', 'booked' => false],
                    ['time' => '8:30 AM', 'booked' => false],
                    ['time' => '9:00 AM', 'booked' => true],
                    ['time' => '12:00 PM', 'booked' => true],
                    ['time' => '4:00 PM', 'booked' => false],
                    ['time' => '4:30 PM', 'booked' => false],
                ],
            ],
            5 => [
                'id' => 5,
                'name' => 'Dr. Emily Chen',
                'specialty' => 'Neurologist',
                'practice' => 'Hospital',
                'practice_key' => 'hospital',
                'gender' => 'Female',
                'availability' => 'unavailable',
                'fee' => 1200,
                'experience' => 18,
                'education' => 'MBBS, DM (Neurology) — NIMHANS Bangalore',
                'languages' => ['English', 'Hindi', 'Mandarin'],
                'about' => 'Dr. Emily Chen is a leading neurologist with 18 years of experience in treating neurological disorders including epilepsy, stroke, and neurodegenerative diseases.',
                'slots' => [],
            ],
            6 => [
                'id' => 6,
                'name' => 'Dr. Kavita Nair',
                'specialty' => 'Gynecologist',
                'practice' => 'Private Clinic',
                'practice_key' => 'private',
                'gender' => 'Female',
                'availability' => 'available',
                'fee' => 900,
                'experience' => 14,
                'education' => 'MBBS, MS (OB-GYN) — Grant Medical College',
                'languages' => ['English', 'Hindi', 'Malayalam'],
                'about' => 'Dr. Kavita Nair is an experienced gynecologist with 14 years of practice in women\'s health, prenatal care, and minimally invasive gynecologic surgery.',
                'slots' => [
                    ['time' => '9:00 AM', 'booked' => false],
                    ['time' => '9:30 AM', 'booked' => true],
                    ['time' => '11:00 AM', 'booked' => true],
                    ['time' => '11:30 AM', 'booked' => false],
                    ['time' => '3:30 PM', 'booked' => false],
                    ['time' => '4:00 PM', 'booked' => false],
                ],
            ],
            7 => [
                'id' => 7,
                'name' => 'Dr. Rahul Verma',
                'specialty' => 'General Physician',
                'practice' => 'Private Clinic',
                'practice_key' => 'private',
                'gender' => 'Male',
                'availability' => 'available',
                'fee' => 400,
                'experience' => 6,
                'education' => 'MBBS, MD (General Medicine) — Maulana Azad Medical College',
                'languages' => ['English', 'Hindi'],
                'about' => 'Dr. Rahul Verma is a compassionate general physician with 6 years of experience. He provides comprehensive primary care including health check-ups, chronic disease management, and preventive medicine.',
                'slots' => [
                    ['time' => '8:30 AM', 'booked' => false],
                    ['time' => '9:00 AM', 'booked' => false],
                    ['time' => '9:30 AM', 'booked' => false],
                    ['time' => '11:00 AM', 'booked' => false],
                    ['time' => '11:30 AM', 'booked' => false],
                    ['time' => '4:00 PM', 'booked' => false],
                    ['time' => '4:30 PM', 'booked' => false],
                ],
            ],
            8 => [
                'id' => 8,
                'name' => 'Dr. Vikram Sinha',
                'specialty' => 'ENT Specialist',
                'practice' => 'Hospital',
                'practice_key' => 'hospital',
                'gender' => 'Male',
                'availability' => 'fully-booked',
                'fee' => 650,
                'experience' => 9,
                'education' => 'MBBS, MS (ENT) — PGIMER Chandigarh',
                'languages' => ['English', 'Hindi', 'Punjabi'],
                'about' => 'Dr. Vikram Sinha is a dedicated ENT specialist with 9 years of experience in ear, nose, and throat disorders. He specialises in endoscopic sinus surgery and hearing restoration procedures.',
                'slots' => [
                    ['time' => '9:30 AM', 'booked' => true],
                    ['time' => '10:00 AM', 'booked' => true],
                    ['time' => '1:00 PM', 'booked' => true],
                    ['time' => '1:30 PM', 'booked' => true],
                    ['time' => '3:30 PM', 'booked' => true],
                ],
            ],
            9 => [
                'id' => 9,
                'name' => 'Dr. Ananya Das',
                'specialty' => 'Ophthalmologist',
                'practice' => 'Private Clinic',
                'practice_key' => 'private',
                'gender' => 'Female',
                'availability' => 'unavailable',
                'fee' => 1100,
                'experience' => 20,
                'education' => 'MBBS, MS (Ophthalmology) — Sankara Nethralaya',
                'languages' => ['English', 'Hindi', 'Bengali'],
                'about' => 'Dr. Ananya Das is a highly regarded ophthalmologist with 20 years of experience in cataract surgery, retinal disorders, and LASIK procedures.',
                'slots' => [],
            ],
        ];
    }

    /**
     * Display the doctor profile page.
     */
    public function show(int $id)
    {
        $doctors = $this->getDoctors();

        if (!isset($doctors[$id])) {
            abort(404);
        }

        $doctor = $doctors[$id];

        return view('doctor-profile', compact('doctor'));
    }

    /**
     * Handle booking an appointment (static demo).
     */
    public function book(Request $request, int $id)
    {
        $doctors = $this->getDoctors();

        if (!isset($doctors[$id])) {
            abort(404);
        }

        $slot = $request->input('slot');

        return redirect()
            ->route('doctor.show', $id)
            ->with('success', 'Appointment booked successfully for ' . $slot . ' with ' . $doctors[$id]['name'] . '!');
    }
}
