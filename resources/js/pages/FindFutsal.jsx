import { useState, useEffect } from "react";
import {
  FaSearch,
  FaMapMarkerAlt,
  FaUsers,
  FaCalendarAlt,
} from "react-icons/fa";

export default function FindFutsal() {
  const [searchTerm, setSearchTerm] = useState("");
  const [sortOrder, setSortOrder] = useState("low-to-high");
  const [futsals, setFutsals] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchFutsals = async () => {
      try {
        // const response = await fetch("http://localhost:8000/api/futsals");
        // const data = await response.json();

        const data = [
          {
            id: 1,
            name: "Imperial rulz futsal",
            location: "Sagbari, Kaushaltar",
            type: "5-a-side",
            available: "Available Today",
            price: 1200,
            image:
              "https://upload.wikimedia.org/wikipedia/commons/3/3b/Football_field_in_Kathmandu.jpg",
            features: ["Parking"],
          },
          {
            id: 2,
            name: "Budhanagar Futsal",
            location: "Sankhamul, Kathmandu",
            type: "5-a-side",
            available: "Available Today",
            price: 1500,
            image:
              "https://upload.wikimedia.org/wikipedia/commons/8/8c/Indoor_futsal_pitch.jpg",
            features: ["Parking", "Changing Room", "Shower", "WiFi"],
          },
        ];

        setFutsals(data);
      } catch (error) {
        console.error("Error fetching futsals:", error);
      } finally {
        setLoading(false);
      }
    };

    fetchFutsals();
  }, []);

  const handleSearch = (e) => {
    e.preventDefault();
  };

  const filteredFutsals = futsals.filter(
    (f) =>
      f.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
      f.location.toLowerCase().includes(searchTerm.toLowerCase())
  );

  const sortedFutsals = [...filteredFutsals].sort((a, b) => {
    if (sortOrder === "low-to-high") return a.price - b.price;
    if (sortOrder === "high-to-low") return b.price - a.price;
    return 0;
  });

  return (
    <section className="relative">
      <div className="bg-emerald-800 text-white px-14 py-24">
        <div>
          <h1 className="text-3xl md:text-5xl font-bold mb-2">Find Futsals</h1>
          <p className="md:text-s text-lg">
            Discover and book the best futsal courts in your area
          </p>
        </div>
      </div>

      <div className="py-10 px-6">
        <form
          onSubmit={handleSearch}
          className="max-w-2xl mx-auto flex rounded-lg shadow-lg overflow-hidden mb-8"
        >
          <input
            type="text"
            placeholder="Search by name or location..."
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
            className="border-none flex-1 px-4 py-3 text-gray-700 rounded-lg focus:outline-none"
          />
          <button
            type="submit"
            className="bg-green-600 text-white px-6 flex items-center gap-2 font-semibold hover:bg-green-700 transition"
          >
            <FaSearch className="text-white" />
            Search
          </button>
        </form>

        <div className="max-w-5xl mx-auto flex justify-between items-center mb-6">
  <p className="text-lg font-semibold">
    {sortedFutsals.length} futsal
    {sortedFutsals.length !== 1 && "s"} found
  </p>

  {/* Sort dropdown */}
  <div className="flex items-center gap-3 text-gray-700">
    <span className="font-medium whitespace-nowrap">Sort by:</span>
    <div className="relative">
      <select
        value={sortOrder}
        onChange={(e) => setSortOrder(e.target.value)}
        className="appearance-none border rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 pr-8"
      >
        <option value="low-to-high">Price: Low to High</option>
        <option value="high-to-low">Price: High to Low</option>
      </select>
      {/* Custom dropdown icon */}
      <svg
        className="w-4 h-4 text-gray-600 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
      >
        <path
          strokeLinecap="round"
          strokeLinejoin="round"
          strokeWidth={2}
          d="M19 9l-7 7-7-7"
        />
      </svg>
    </div>
  </div>
</div>

      </div>

      <div className="max-w-5xl mx-auto px-6 pb-20">
        {loading ? (
          <p className="text-center text-gray-500 text-lg">Loading futsals...</p>
        ) : sortedFutsals.length === 0 ? (
          <p className="text-center text-gray-500 text-lg">
            No futsals found.
          </p>
        ) : (
          <div className="space-y-6">
            {sortedFutsals.map((futsal) => (
              <div
                key={futsal.id}
                className="flex flex-col md:flex-row bg-white shadow rounded-lg overflow-hidden"
              >
                <div className="md:w-1/3">
                  <img
                    src={futsal.image}
                    alt={futsal.name}
                    className="w-full h-56 object-cover"
                  />
                </div>

                <div className="p-6 flex flex-col justify-between md:w-2/3">
                  <div>
                    <h2 className="text-xl font-bold mb-1">{futsal.name}</h2>
                    <p className="text-gray-600 flex items-center gap-2">
                      <FaMapMarkerAlt /> {futsal.location}
                    </p>

                    <div className="flex items-center gap-4 text-sm text-gray-600 mt-3">
                      <span className="flex items-center gap-1">
                        <FaUsers /> {futsal.type}
                      </span>
                      <span className="flex items-center gap-1">
                        <FaCalendarAlt /> {futsal.available}
                      </span>
                    </div>

                    <div className="flex flex-wrap gap-2 mt-4">
                      {futsal.features.map((feature, i) => (
                        <span
                          key={i}
                          className="bg-gray-100 text-gray-800 text-sm px-3 py-1 rounded-md"
                        >
                          {feature}
                        </span>
                      ))}
                    </div>
                  </div>

                  <div className="flex justify-between items-center mt-6">
                    <p className="text-green-700 text-2xl font-bold">
                      Rs. {futsal.price.toLocaleString()}
                      <span className="text-gray-500 text-sm font-normal">
                        {" "}
                        per hour
                      </span>
                    </p>
                    <button className="bg-gray-100 hover:bg-gray-200 text-gray-900 font-semibold px-6 py-2 rounded-md transition">
                      View Details
                    </button>
                  </div>
                </div>
              </div>
            ))}
          </div>
        )}
      </div>
    </section>
  );
}
