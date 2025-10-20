import { useState } from "react";
import { FaSearch, FaFilter } from "react-icons/fa";
import FutsalBookingPage from "./FutsalBookingPage"
import AddFutsalPage from "../components/AddFutsalPage"
export default function Blog() {
  const [searchTerm, setSearchTerm] = useState("");

  const handleSearch = (e) => {
    e.preventDefault();
    console.log("Searching for:", searchTerm);
  };

  return (
    // <section className="min-h-screen bg-gray-50">
    //   <div className="bg-emerald-800 text-white px-14 py-24">
    //     <div>
    //       <h1 className="text-3xl md:text-5xl font-bold mb-2">Futsal Blogs</h1>
    //       <p className="md:text-s text-lg">
    //         Detailed information about the best futsal facilities in the area
    //       </p>
    //     </div>
    //   </div>
    //   <div className="flex flex-col md:flex-row items-center justify-center gap-4 py-10 px-6">
    //     <form
    //       onSubmit={handleSearch}
    //       className="flex items-center w-full max-w-2xl bg-white rounded-full shadow-md px-4"
    //     >
    //       <FaSearch className="text-gray-500 mr-3" />
    //       <input
    //         type="text"
    //         placeholder="Search blogs..."
    //         value={searchTerm}
    //         onChange={(e) => setSearchTerm(e.target.value)}
    //         className="border-none flex-1 px-4 py-3 text-gray-700 rounded-lg focus:outline-none"
    //       />
    //     </form>

    //   </div>

    //   <div className="max-w-5xl mx-auto px-6 pb-20">
    //     <p className="text-gray-500 text-center">
    //       Blog content will appear here...
    //     </p>
    //   </div>
    // </section>
    // <FutsalBookingPage />
    <AddFutsalPage />
  );
}
