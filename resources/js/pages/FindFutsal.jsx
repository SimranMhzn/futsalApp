import { useState, useEffect } from "react";
import { FaSearch, FaMapMarkerAlt, FaUsers, FaCalendarAlt } from "react-icons/fa";

export default function FindFutsal() {
  const [searchTerm, setSearchTerm] = useState("");
  const [sortOrder, setSortOrder] = useState("low-to-high");
  const [futsals, setFutsals] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchFutsals = async () => {
      try {
        const response = await fetch("http://localhost:8000/futsals", {
          headers: { "Content-Type": "application/json" },
          credentials: "include", // send cookies for auth
        });

        if (!response.ok) throw new Error("Failed to fetch futsals");

        const data = await response.json();

        // Ensure every futsal has photo array
        const formattedData = data.map(futsal => ({
          ...futsal,
          photo: futsal.photo?.length ? futsal.photo : ["/placeholder.png"],
        }));

        setFutsals(formattedData);
      } catch (error) {
        console.error(error);
      } finally {
        setLoading(false);
      }
    };

    fetchFutsals();
  }, []);

  const filteredFutsals = futsals.filter(
    f => f.name.toLowerCase().includes(searchTerm.toLowerCase()) || f.location.toLowerCase().includes(searchTerm.toLowerCase())
  );

  const sortedFutsals = [...filteredFutsals].sort((a, b) => {
    if (sortOrder === "low-to-high") return parseFloat(a.price) - parseFloat(b.price);
    if (sortOrder === "high-to-low") return parseFloat(b.price) - parseFloat(a.price);
    return 0;
  });

  return (
    <section className="relative">
      <div className="bg-emerald-800 text-white px-14 py-24">
        <h1 className="text-3xl md:text-5xl font-bold mb-2">Find Futsals</h1>
        <p className="md:text-s text-lg">Discover and book the best futsal courts in your area</p>
      </div>

      <div className="py-10 px-6 max-w-5xl mx-auto">
        <div className="mb-8 flex flex-col md:flex-row gap-4">
          <input
            type="text"
            placeholder="Search by name or location..."
            value={searchTerm}
            onChange={e => setSearchTerm(e.target.value)}
            className="flex-1 px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-500"
          />
          <select
            value={sortOrder}
            onChange={e => setSortOrder(e.target.value)}
            className="px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-500"
          >
            <option value="low-to-high">Price: Low to High</option>
            <option value="high-to-low">Price: High to Low</option>
          </select>
        </div>

        <p className="text-lg font-semibold mb-6">
          {sortedFutsals.length} futsal{sortedFutsals.length !== 1 && "s"} found
        </p>

        {loading ? (
          <p className="text-center text-gray-500 text-lg">Loading futsals...</p>
        ) : sortedFutsals.length === 0 ? (
          <p className="text-center text-gray-500 text-lg">No futsals found.</p>
        ) : (
          <div className="space-y-6">
            {sortedFutsals.map(futsal => (
              <div key={futsal.id} className="flex flex-col md:flex-row bg-white shadow rounded-lg overflow-hidden">
                <div className="md:w-1/3">
                  <img src={futsal.photo[0]} alt={futsal.name} className="w-full h-56 object-cover" />
                </div>

                <div className="p-6 flex flex-col justify-between md:w-2/3">
                  <div>
                    <h2 className="text-xl font-bold mb-1">{futsal.name}</h2>
                    <p className="text-gray-600 flex items-center gap-2">
                      <FaMapMarkerAlt /> {futsal.location}
                    </p>
                  </div>
                  <div className="flex justify-between items-center mt-6">
                    <p className="text-green-700 text-2xl font-bold">
                      Rs. {parseFloat(futsal.price).toLocaleString()}
                      <span className="text-gray-500 text-sm font-normal"> per hour</span>
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
