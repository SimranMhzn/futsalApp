import { Button, Card } from "flowbite-react";
import Navbar from "./Navbar";
import {FaFacebook, FaInstagram, FaTwitter} from "react-icons/fa";
export default function Home() {
  return (
    <>
      <Navbar/>
      <div className="bg-gray-50 dark:bg-gray-900 min-h-screen">
        <section className="flex flex-col items-center justify-center text-center py-24 px-4 bg-gradient-to-r from-green-500 to-green-950 text-white">
          <h1 className="text-5xl md:text-6xl font-extrabold mb-4">
            Book Your Futsal Court Instantly
          </h1>
          <p className="text-lg md:text-xl mb-8">
            Find available courts near you and reserve your spot in seconds.
          </p>
          <Button color="success" size="lg" className="border-2 border-white hover:scale-105 transition-transform mx-auto">
            Book Now
          </Button>
        </section>


        <section className="max-w-6xl mx-auto py-20 px-4">
          <h2 className="text-3xl font-semibold text-gray-900 dark:text-white mb-12 text-center">
            Why Choose FutsalHub?
          </h2>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            <Card className="border-green-400 hover:shadow-lg transition-shadow ">
              <h3 className="text-xl font-bold mb-2 text-green-600">Quick Booking</h3>
              <p>Book your favourite futsal court in less than a minute. No phone calls needed.</p>
            </Card>

            <Card className="border-green-400 hover:shadow-lg transition-shadow">
              <h3 className="text-xl font-bold mb-2 text-green-600">Find Nearby Courts</h3>
              <p>Discover the ebst futsal courts near your location with real-time availability.</p>
            </Card>

            <Card className="border-green-400 hover:shadow-lg transition-shadow">
              <h3 className="text-xl font-bold mb-2 text-green-600">Verified Venues</h3>
              <p>All futsal courts are verified for quality and facilities. Play with confidence.</p>
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
      </div>
      <div className="bg-green-700 text-white">
        <div className="text-center py-12">
          <h2 className="text-2xl font-bold mb-2">
            Ready to Find Your Perfect Futsal Court?
          </h2>
          <p className="mb-6">
            Join thousands of futsal players who book courts through Booksall
            every day. <br />
            Fast, easy, and reliable.
          </p>
          <div className="flex justify-center gap-4">
            <Button color="light" className="font-bold">
              Browse Futsals
            </Button>
            <Button color="light" className="font-bold border-2 border-white">
              Create Free Account
            </Button>
          </div>
        </div>
      </div>
      <footer className="bg-green-900 px-8 py-10">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 text-gray-200">
          <div>
            <h3 className="font-bold text-lg text-white">FutsalHub</h3>
            <p className="mt-2 text-sm">
              The easiest way to book futsal courts near you. Play more,
              worry less.
            </p>
            <div className="flex gap-4 mt-4 text-xl">
              <FaFacebook className="hover:text-white cursor-pointer" />
              <FaInstagram className="hover:text-white cursor-pointer" />
              <FaTwitter className="hover:text-white cursor-pointer" />
            </div>
          </div>

          <div>
            <h3 className="font-bold text-lg text-white">Quick Links</h3>
            <ul className="mt-2 space-y-2 text-sm">
              <li><a href="#" className="hover:underline">Home</a></li>
              <li><a href="#" className="hover:underline">Find Futsals</a></li>
              <li><a href="#" className="hover:underline">About Us</a></li>
              <li><a href="#" className="hover:underline">Contact</a></li>
            </ul>
          </div>

          <div>
            <h3 className="font-bold text-lg text-white">Contact Us</h3>
            <ul className="mt-2 space-y-2 text-sm">
              <li>Kathmandu, Nepal</li>
              <li>info@futsalhub.app</li>
              <li>+977 9800000000</li>
            </ul>
          </div>
        </div>

        <div className="border-t border-gray-500 mt-8 pt-4 flex flex-col md:flex-row justify-between text-sm text-gray-300">
          <p>© 2025 FutsalHub. All rights reserved.</p>
          <div className="flex gap-4 mt-2 md:mt-0">
            <a href="#" className="hover:underline">Privacy Policy</a>
            <a href="#" className="hover:underline">Terms of Service</a>
          </div>
        </div>
      </footer>
    </>
  );
}
