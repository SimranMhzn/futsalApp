import { useState } from "react";
import { FaSearch } from "react-icons/fa";

export default function FindFutsal() {
  const [searchTerm, setSearchTerm] = useState("");

  const handleSearch = (e) => {
    e.preventDefault();
    console.log("Searching for:", searchTerm);
  };

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
          className="max-w-2xl mx-auto flex rounded-lg shadow-lg overflow-hidden"
        >
          <input
            type="text"
            placeholder="Search by name or location..."
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
            className="border-none flex-1 px-4 py-3 text-gray-700 rounded-lg"
          />
          <button
            type="submit"
            className="bg-green-600 text-white px-6 flex items-center gap-2 font-semibold hover:bg-green-700 transition"
          >
            <FaSearch className="text-white" />
            Search
          </button>
        </form>
      </div>
    </section>
  );
}
