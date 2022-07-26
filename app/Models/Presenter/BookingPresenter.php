<?php

namespace App\Models\Presenter;

use App\Models\Booking;

class BookingPresenter extends \Laracasts\Presenter\Presenter
{
    /**
     * @return string
     */
    public function showTotalPrice(): string
    {
        $price = 0;
        foreach ($this->bookingService as $service) {
            $price += $service->service->price - $service->service->price * $service->service->discount / 100;
        }
        return number_format($price, 0, '', ',') . 'VNĐ';
    }

    /**
     * @return string
     */
    public function showPriceWithDiscount(): string
    {
        $priceDiscount = $this->service->price - $this->service->price * $this->service->discount / 100;

        return number_format($priceDiscount, 0, '', ',') . 'VNĐ';
    }

    /**
     * @return string
     */
    public function getListService(): string
    {
        $listService = [];
        foreach ($this->bookingService as $service) {
            $listService[] = $service->service->name;
        }
        return implode(', ', $listService);
    }

    /**
     * @return string
     */
    public function getServicePrice(): string
    {
        $discount = 0;
        $price = 0;
        $priceWithDiscount = 0;
        foreach ($this->bookingService as $service) {
            $price += $service->service->price - $service->service->price * $service->service->discount / 100;
        }
        if ($this->discount) {
            $priceWithDiscount = $price - $price * $discount / 100;
        }

        return number_format($priceWithDiscount, 0, '', ',') . 'VNĐ';
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        if ($this->status == Booking::SOLVED) {
            $statusString = 'Đã hoàn thành';
        } else if ($this->status == Booking::CANCEL) {
            $statusString = 'Đã hủy';
        } else {
            $statusString = 'Chưa hoàn thành';
        }

        return $statusString;
    }
}
