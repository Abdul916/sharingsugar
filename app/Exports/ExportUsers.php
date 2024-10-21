<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportUsers implements FromCollection, WithHeadings
{
	public function collection()
	{
		return User::select('first_name', 'last_name', 'email', 'interestedin', 'dob', 'height', 'weight', 'body_type', 'child', 'city', 'state', 'zipcode', 'country', 'address', 'gender', 'latitude', 'longitude', 'status', 'created_at')
		->get()
		->map(function ($user) {
			return [
				'first_name' => $user->first_name,
				'last_name' => $user->last_name,
				'email' => $user->email,
				'interestedin' => $user->interestedin,
				'dob' => $user->dob,
				'height' => $user->height,
				'weight' => $user->weight,
				'body_type' => $this->MatchBodytype($user->body_type),
				'child' => $user->child,
				'city' => $user->city,
				'state' => $user->state,
				'zipcode' => $user->zipcode,
				'country' => $user->country,
				'address' => $user->address,
				'gender' => $this->MatchGender($user->gender),
				'latitude' => $user->latitude,
				'longitude' => $user->longitude,
				'status' => $this->MatchStatus($user->status),
				'created_at' => $user->created_at->format('Y-m-d'),
			];
		});;
	}

	public function headings(): array
	{
		return [
			'First Name',
			'Last Name',
			'Email',
			'interested in',
			'DOB',
			'Height',
			'Weight',
			'Body Type',
			'Child',
			'City',
			'State',
			'Zip Code',
			'Country',
			'Address',
			'Gender',
			'Latitude',
			'Longitude',
			'Status',
			'Created Date',
		];
	}

	private function MatchBodytype($status)
	{
		switch ($status) {
			case 1:
			return 'Skinny';
			case 2:
			return 'Thin';
			case 3:
			return 'Median';
			case 4:
			return 'Athletic';
			case 5:
			return 'Curvilinear';
			case 6:
			return 'Full Height';
			default:
			return 'Unknown';
		}
	}

	private function MatchGender($status)
	{
		switch ($status) {
			case 1:
			return 'Male';
			case 2:
			return 'Female';
			case 3:
			return 'Trans';
			default:
			return 'Unknown';
		}
	}

	private function MatchStatus($status)
	{
		switch ($status) {
			case 1:
			return 'Active';
			case 2:
			return 'Inactive';
			case 3:
			return 'Deleted';
			default:
			return 'Unknown';
		}
	}
}
