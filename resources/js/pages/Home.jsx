import { Button, Card } from "flowbite-react";

export default function Home() {
  return (
    <>
      <nav className="bg-white border-b border-gray-200 dark:bg-gray-900 dark:border-gray-700">
        <div className="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
          <img src="" className="h-10" alt="Futsal Logo" />
          <div className="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <button
              type="button"
              className="flex text-sm bg-green-600 hover:bg-green-700 rounded-full md:me-0 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-600"
              id="user-menu-button"
              aria-expanded="false"
              data-dropdown-toggle="user-dropdown"
              data-dropdown-placement="bottom"
            >
              <span className="sr-only">Open user menu</span>
              <img
                className="w-8 h-8 rounded-full"
                src="/docs/images/people/profile-picture-3.jpg"
                alt="user photo"
              />
            </button>
            <div
              className="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-700 dark:divide-gray-600"
              id="user-dropdown"
            >
              <div className="px-4 py-3">
                <span className="block text-sm text-gray-900 dark:text-white">
                  Bonnie Green
                </span>
                <span className="block text-sm text-gray-500 truncate dark:text-gray-400">
                  name@flowbite.com
                </span>
              </div>
              <ul className="py-2" aria-labelledby="user-menu-button">
                {["Dashboard", "Settings", "Earnings", "Sign out"].map(
                  (item, idx) => (
                    <li key={idx}>
                      <a
                        href="#"
                        className="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100 dark:hover:bg-green-700 dark:text-gray-200 dark:hover:text-white"
                      >
                        {item}
                      </a>
                    </li>
                  )
                )}
              </ul>
            </div>
          </div>
          <div
            className="items-center justify-between hidden w-full md:flex md:w-auto md:order-1"
            id="navbar-user"
          >
            <ul className="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
              {["Home", "About", "Services", "Pricing", "Contact"].map(
                (item, idx) => (
                  <li key={idx}>
                    <a
                      href="#"
                      className="block py-2 px-3 text-white bg-green-600 rounded-sm md:bg-transparent md:text-green-600 md:p-0 md:dark:text-green-500 hover:bg-green-700 md:hover:bg-transparent md:hover:text-green-700 dark:hover:bg-green-700 dark:hover:text-white"
                      aria-current={idx === 0 ? "page" : undefined}
                    >
                      {item}
                    </a>
                  </li>
                )
              )}
            </ul>
          </div>
        </div>
      </nav>

      <div className="bg-gray-50 dark:bg-gray-900 min-h-screen">
        <section className="text-center py-24 px-4 bg-gradient-to-r from-green-500 to-green-700 text-white">
          <h1 className="text-5xl md:text-6xl font-extrabold mb-4">
            Book Your Futsal Court Instantly
          </h1>
          <p className="text-lg md:text-xl mb-8">
            Find available courts near you and reserve your spot in seconds.
          </p>
          <Button color="success" size="lg" className="hover:scale-105 transition-transform">
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
