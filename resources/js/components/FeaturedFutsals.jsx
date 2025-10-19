import { useEffect, useState } from "react";
import { Button, Card } from "flowbite-react";
import { MdLocationOn, MdStar } from "react-icons/md";

export default function FeaturedFutsals({ onFindFutsals }) {
  const [futsals, setFutsals] = useState([]);

  useEffect(() => {
    const fetchFutsals = async () => {
      const data = [
        {
          id: 1,
          name: "Imperial rulz futsal",
          location: "Sagbari, Kaushaltar",
          price: 1200,
          image: "/futsalCover1.webp",
          rating: null,
        },
        {
          id: 2,
          name: "Budhhanagar Futsal",
          location: "Sankhamul, Kathmandu",
          price: 1500,
          image: "/futsalCover2.webp",
          rating: null,
        },
      ];
      setFutsals(data);
    };
    fetchFutsals();
  }, []);

  return (
    <section className="mx-auto max-w-7xl px-6 py-20">
      <div className="mb-10 flex items-center justify-between">
        <h2 className="text-4xl font-semibold text-gray-900 dark:text-white">
          Featured Futsals
        </h2>
        <button
          onClick={onFindFutsals}
          className="text-green-600 hover:text-green-800 font-semibold flex items-center gap-1"
        >
          View All →
        </button>
      </div>

      <div className="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        {futsals.map((futsal) => (
          <Card
            key={futsal.id}
            className="overflow-hidden rounded-xl transition-transform hover:scale-[1.02]"
          >
            <img
              src={futsal.image}
              alt={futsal.name}
              className="h-56 w-full object-cover"
            />
            <div className="p-5">
              <h3 className="text-xl font-bold text-gray-900 dark:text-white">
                {futsal.name}
              </h3>

              <div className="flex items-center gap-1 text-sm text-gray-500">
                <MdLocationOn className="text-green-600" />
                <span>{futsal.location}</span>
              </div>

              <div className="mt-2 flex items-center justify-between">
                <p className="font-semibold text-green-600">
                  NRs. {futsal.price.toLocaleString()}/hour
                </p>
                <div className="flex items-center text-gray-500">
                  <MdStar className="text-yellow-400" />
                  <span className="ml-1 text-sm">{futsal.rating || "N/A"}</span>
                </div>
              </div>

              <Button className="mt-4 w-full rounded-lg bg-green-100 text-green-700 hover:bg-green-200">
                View Details
              </Button>
            </div>
          </Card>
        ))}
      </div>

      <div className="mt-14 flex justify-center">
        <Button
          onClick={onFindFutsals}
          className="rounded-xl bg-green-600 px-6 py-3 font-semibold text-white shadow-md transition-transform hover:scale-105 hover:bg-green-700"
        >
          Explore All Futsals
        </Button>
      </div>
    </section>
  );
}
