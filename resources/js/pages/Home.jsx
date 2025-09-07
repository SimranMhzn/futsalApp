import { Button, Card } from "flowbite-react";
import Navbar from "./Navbar";
export default function Home() {
  return (
    <>
      <Navbar/>

      <div className="bg-gray-50 dark:bg-gray-900 min-h-screen">
        <section className="flex flex-col items-center justify-center text-center py-24 px-4 bg-gradient-to-r from-green-500 to-green-700 text-white">
          <h1 className="text-5xl md:text-6xl font-extrabold mb-4">
            Book Your Futsal Court Instantly
          </h1>
          <p className="text-lg md:text-xl mb-8">
            Find available courts near you and reserve your spot in seconds.
          </p>
          <Button color="success" size="lg" className="border-2 border-white hover:scale-105 transition-transform mx-auto">
            Book a Court
          </Button>
        </section>


        <section className="max-w-6xl mx-auto py-20 px-4">
          <h2 className="text-3xl font-semibold text-gray-900 dark:text-white mb-12 text-center">
            Our Services
          </h2>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            <Card className="border-green-400 hover:shadow-lg transition-shadow">
              <h3 className="text-xl font-bold mb-2 text-green-600">Easy Booking</h3>
              <p>Reserve futsal courts online anytime, anywhere without waiting.</p>
            </Card>

            <Card className="border-green-400 hover:shadow-lg transition-shadow">
              <h3 className="text-xl font-bold mb-2 text-green-600">Flexible Timings</h3>
              <p>Choose slots that fit your schedule. Morning, evening, or night!</p>
            </Card>

            <Card className="border-green-400 hover:shadow-lg transition-shadow">
              <h3 className="text-xl font-bold mb-2 text-green-600">Secure Payments</h3>
              <p>Pay online safely and get instant confirmation for your booking.</p>
            </Card>
          </div>
        </section>


        <section className="bg-gray-100 dark:bg-gray-800 py-20 px-4">
          <h2 className="text-3xl font-semibold text-gray-900 dark:text-white mb-16 text-center">
            How It Works
          </h2>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-6xl mx-auto">
            {[
              { step: "1️⃣", title: "Select Court", desc: "Browse available futsal courts near you." },
              { step: "2️⃣", title: "Pick Time", desc: "Choose your preferred slot and date." },
              { step: "3️⃣", title: "Confirm & Pay", desc: "Complete payment online and receive instant confirmation." },
            ].map((item, idx) => (
              <div key={idx} className="text-center p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <div className="text-green-600 text-5xl mb-4">{item.step}</div>
                <h3 className="font-bold mb-2 text-gray-900 dark:text-white">{item.title}</h3>
                <p className="text-gray-700 dark:text-gray-300">{item.desc}</p>
              </div>
            ))}
          </div>
        </section>


        <section className="text-center py-20 px-4">
          <h2 className="text-4xl font-bold mb-4 text-green-700 dark:text-green-400">
            Ready to Play?
          </h2>
          <p className="text-gray-700 dark:text-gray-300 mb-6">
            Book your futsal court today and never miss a game!
          </p>
          <Button color="success" size="lg" className="hover:scale-105 transition-transform">
            Reserve Now
          </Button>
        </section>
      </div>
    </>
  );
}
