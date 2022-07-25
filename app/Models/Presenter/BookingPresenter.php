<?php

namespace App\Models\Presenter;

class BookingPresenter extends \Laracasts\Presenter\Presenter
{
    /**
     * @return string
     */
    public function showTotalPrice(): string
    {
        $price = 0;
        foreach ($this->bookingService as $service) {
            $price +=  $service->service->price - $service->service->price * $service->service->discount / 100;
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
}
