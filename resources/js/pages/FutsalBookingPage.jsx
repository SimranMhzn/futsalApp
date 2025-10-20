
import React, { useState } from 'react';

const FutsalBookingPage = () => {
  const futsal = {
    name: "Imperial Rulz Futsal",
    location: "Sagbari, Kaushaltar",
    about: "Good Environment futsal located in Sagbari Kaushaltar with a new turf.\nExclusive Booksall Offer: 10% discount coming from Booksall from 6AM to 2PM in Imperial Rulz Futsal.",
    features: ["5-a-side", "Parking", "Cafeteria", "Locker Room"],
    pricing: [
      { day: "Weekdays", price: 1200 },
      { day: "Saturday", price: 1500 },
    ],
    contact: {
      phone: "9763694196",
      location: "Sagbari, Kaushaltar",
    },
    bookingPrice: 1200,
    hours: [
      "6-7","7-8","8-9","9-10","10-11","11-12",
      "12-13","13-14","14-15","15-16","16-17","17-18",
      "18-19","19-20","20-21"
    ],
    images: [
      "https://images.unsplash.com/photo-1599058917210-7fc74e1b2b50?auto=format&fit=crop&w=800&q=80",
      "https://images.unsplash.com/photo-1605902711622-cfb43c4434b9?auto=format&fit=crop&w=800&q=80",
      "https://images.unsplash.com/photo-1571019613576-2d30f26a8b90?auto=format&fit=crop&w=800&q=80"
    ],
  };

  const [selectedDate, setSelectedDate] = useState("");
  const [selectedHour, setSelectedHour] = useState(""); // single selection

  const selectHour = (hour) => {
    setSelectedHour(hour);
  };

  return (
    <div className="max-w-6xl mx-auto p-6 space-y-6">
      {/* Photo Section */}
      <div className="w-full h-64 lg:h-96 relative rounded-lg overflow-hidden shadow-lg">
        <img
          src={futsal.images[0]}
          alt={futsal.name}
          className="w-full h-full object-cover"
        />
        <div className="absolute inset-0 bg-green-900 bg-opacity-30 flex flex-col justify-end p-6 rounded-lg">
          <h1 className="text-3xl lg:text-4xl font-bold text-white">{futsal.name}</h1>
          <p className="text-white mt-1">{futsal.location}</p>
        </div>
      </div>

      <div className="flex flex-col lg:flex-row gap-6">
        {/* Left Column */}
        <div className="flex-1 space-y-6">
          {/* About */}
          <div className="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
            <h2 className="font-semibold text-green-600 mb-2 text-lg">About This Futsal</h2>
            <p className="text-gray-700 whitespace-pre-line">{futsal.about}</p>
          </div>

          {/* Features */}
          <div className="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
            <h2 className="font-semibold text-green-600 mb-2 text-lg">Features & Amenities</h2>
            <div className="flex flex-wrap gap-2">
              {futsal.features.map((feature, i) => (
                <span key={i} className="bg-green-50 text-green-700 px-3 py-1 rounded-full text-sm font-medium">{feature}</span>
              ))}
            </div>
          </div>

          {/* Pricing */}
          <div className="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
            <h2 className="font-semibold text-green-600 mb-2 text-lg">Pricing Details</h2>
            <table className="w-full text-left border border-gray-200 rounded">
              <thead className="bg-green-50">
                <tr>
                  <th className="py-2 px-3">Day</th>
                  <th className="py-2 px-3">Price (NRs./hour)</th>
                </tr>
              </thead>
              <tbody>
                {futsal.pricing.map((p, i) => (
                  <tr key={i} className="border-t border-gray-100">
                    <td className="py-2 px-3">{p.day}</td>
                    <td className="py-2 px-3">{p.price.toLocaleString()}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>

          {/* Contact */}
          <div className="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
            <h2 className="font-semibold text-green-600 mb-2 text-lg">Contact Information</h2>
            <p><span className="font-semibold">Phone:</span> {futsal.contact.phone}</p>
            <p><span className="font-semibold">Location:</span> {futsal.contact.location}</p>
          </div>
        </div>

        {/* Right Column - Booking */}
        <div className="w-full lg:w-1/3 bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300 space-y-4">
          <div className="flex justify-between items-center mb-2">
            <h2 className="font-semibold text-green-600 text-lg">Book Your Slot</h2>
            <span className="font-bold text-lg">{futsal.bookingPrice.toLocaleString()} NRs./hour</span>
          </div>

          {/* Date Picker */}
          <div>
            <label className="block mb-1 font-medium text-gray-700">Select Date:</label>
            <input
              type="date"
              className="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
              value={selectedDate}
              onChange={(e) => setSelectedDate(e.target.value)}
            />
          </div>

          {/* Hours */}
          <div>
            <label className="block mb-1 font-medium text-gray-700">Select Time:</label>
            <div className="grid grid-cols-3 gap-2">
              {futsal.hours.map((hour, i) => (
                <button
                  key={i}
                  onClick={() => selectHour(hour)}
                  className={`py-2 px-2 rounded text-sm font-medium transition-colors duration-200 ${
                    selectedHour === hour
                      ? "bg-green-600 text-white"
                      : "bg-green-50 text-green-700 hover:bg-green-100"
                  }`}
                >
                  {hour}
                </button>
              ))}
            </div>
          </div>

          <button
            disabled={!selectedDate || !selectedHour}
            className={`w-full py-3 rounded text-white font-semibold text-lg transition-colors duration-200 ${
              !selectedDate || !selectedHour
                ? 'bg-gray-400 cursor-not-allowed'
                : 'bg-green-600 hover:bg-green-700'
            }`}
          >
            BOOK NOW
          </button>

          {!selectedDate || !selectedHour && (
            <p className="text-gray-500 text-xs mt-1">Select a date and time slot to continue</p>
          )}
        </div>
      </div>
    </div>
  );
};

export default FutsalBookingPage;
