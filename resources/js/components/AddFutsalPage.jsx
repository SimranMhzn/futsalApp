import React, { useState } from "react";
import axios from "axios";

const AddFutsalPage = () => {
  const [formData, setFormData] = useState({
    name: "",
    phone: "",
    price: "",
    location: "",
    link: "",
    side_no: "",
    ground_no: "",
    description: "",
    shower_facility: false,
    parking_space: false,
    changing_room: false,
    restaurant: false,
    wifi: false,
    open_ground: false,
  });

  const [images, setImages] = useState(Array(5).fill(null));
  const [errors, setErrors] = useState({});
  const [serverError, setServerError] = useState("");
  const [loading, setLoading] = useState(false);

  const validateField = (name, value) => {
    let message = "";

    switch (name) {
      case "name":
        if (!value.trim()) message = "Futsal name is required.";
        break;
      case "phone":
        if (!/^\d{10}$/.test(value)) message = "Phone number must be 10 digits.";
        break;
      case "price":
        if (value <= 500) message = "Price must be more than 500.";
        break;
      case "side_no":
      case "ground_no":
        if (value < 0) message = "Value cannot be negative.";
        break;
      case "link":
        if (value && !/^https?:\/\/.+/.test(value)) message = "Invalid URL.";
        break;
      default:
        break;
    }

    setErrors((prev) => ({ ...prev, [name]: message }));
  };

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prev) => ({ ...prev, [name]: value }));
    validateField(name, value);
  };

  const handleAmenityChange = (e) => {
    const { name, checked } = e.target;
    setFormData((prev) => ({ ...prev, [name]: checked }));
  };

  const handleImageUpload = (index, file) => {
    if (!file) return;

    if (!file.type.startsWith("image/")) {
      alert("❌ Only images allowed!");
      return;
    }
    if (file.size > 2 * 1024 * 1024) {
      alert("❌ Max 2MB per image!");
      return;
    }

    const newImages = [...images];
    newImages[index] = file;
    setImages(newImages);
  };

  const validateForm = () => {
    const newErrors = {};
    Object.entries(formData).forEach(([key, value]) => validateField(key, value));
    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setServerError("");
    if (!validateForm()) return;

    setLoading(true);
    try {
      const data = new FormData();

      // Append text + boolean fields
      Object.entries(formData).forEach(([key, value]) => {
        data.append(key, value);
      });

      // Append image files
      images.forEach((img) => {
        if (img) data.append("photo[]", img);
      });

      // ✅ Send cookies for Laravel session authentication
      const response = await axios.post("http://localhost:8000/futsals", data, {
        headers: { "Content-Type": "multipart/form-data" },
        withCredentials: true, // crucial for Auth::id() to work in Laravel
      });

      alert("✅ Futsal registered successfully!");

      // Reset form
      setFormData({
        name: "",
        phone: "",
        price: "",
        location: "",
        link: "",
        side_no: "",
        ground_no: "",
        description: "",
        shower_facility: false,
        parking_space: false,
        changing_room: false,
        restaurant: false,
        wifi: false,
        open_ground: false,
      });
      setImages(Array(5).fill(null));
      setErrors({});
    } catch (error) {
      console.error("Futsal registration failed:", error);
      setServerError("❌ Something went wrong. Please try again.");
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="min-h-screen bg-gray-50 py-10">
      <div className="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-10">
        <h1 className="text-3xl font-bold text-green-700 mb-10 text-center">
          🏟️ Register Your Futsal
        </h1>

        {serverError && (
          <p className="bg-red-100 text-red-700 p-3 mb-6 rounded">{serverError}</p>
        )}

        <form onSubmit={handleSubmit} className="space-y-8">
          {/* Basic Info */}
          <section className="space-y-4">
            <h2 className="text-2xl font-semibold text-green-700">Basic Information</h2>
            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
              {[
                { name: "name", placeholder: "Futsal Name *" },
                { name: "phone", placeholder: "Phone Number *" },
                { name: "price", placeholder: "Price per hour (NPR) *", type: "number" },
                { name: "location", placeholder: "Location" },
                { name: "link", placeholder: "Google Maps Link" },
              ].map((field) => (
                <div key={field.name}>
                  <input
                    name={field.name}
                    type={field.type || "text"}
                    value={formData[field.name]}
                    onChange={handleChange}
                    placeholder={field.placeholder}
                    className="border p-3 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-green-500"
                  />
                  {errors[field.name] && (
                    <p className="text-red-500 text-sm mt-1">{errors[field.name]}</p>
                  )}
                </div>
              ))}
            </div>
          </section>

          {/* Facilities */}
          <section className="space-y-4">
            <h2 className="text-2xl font-semibold text-green-700">Facilities & Features</h2>
            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <input
                name="side_no"
                type="number"
                min={0}
                value={formData.side_no}
                onChange={handleChange}
                placeholder="Players per side"
                className="border p-3 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-green-500"
              />
              <input
                name="ground_no"
                type="number"
                min={0}
                value={formData.ground_no}
                onChange={handleChange}
                placeholder="Number of Grounds"
                className="border p-3 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-green-500"
              />
            </div>

            <div className="grid grid-cols-2 sm:grid-cols-3 gap-2 mt-4">
              {[
                { label: "Shower Facility", name: "shower_facility" },
                { label: "Parking Space", name: "parking_space" },
                { label: "Changing Room", name: "changing_room" },
                { label: "Restaurant", name: "restaurant" },
                { label: "WiFi", name: "wifi" },
                { label: "Open Ground", name: "open_ground" },
              ].map((item) => (
                <label
                  key={item.name}
                  className="flex items-center gap-2 p-2 border rounded-lg hover:bg-green-50 cursor-pointer"
                >
                  <input
                    type="checkbox"
                    name={item.name}
                    checked={formData[item.name]}
                    onChange={handleAmenityChange}
                  />
                  <span>{item.label}</span>
                </label>
              ))}
            </div>
          </section>

          {/* Description */}
          <section className="space-y-2">
            <textarea
              name="description"
              value={formData.description}
              onChange={handleChange}
              placeholder="Description"
              className="border p-3 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-green-500"
              rows={4}
            />
          </section>

          {/* Images */}
          <section className="space-y-2">
            <h2 className="text-2xl font-semibold text-green-700">Upload Images</h2>
            <div className="grid grid-cols-2 sm:grid-cols-3 gap-4">
              {images.map((img, index) => (
                <label
                  key={index}
                  className="border-2 border-dashed rounded-lg flex flex-col items-center justify-center h-40 cursor-pointer hover:bg-gray-50 transition relative overflow-hidden"
                >
                  {img ? (
                    <img
                      src={URL.createObjectURL(img)}
                      alt={`Upload ${index + 1}`}
                      className="h-full w-full object-cover rounded-lg"
                    />
                  ) : (
                    <span className="text-gray-400">
                      Click to upload {index === 0 ? "(Cover*)" : ""}
                    </span>
                  )}
                  <input
                    type="file"
                    accept="image/*"
                    className="hidden"
                    onChange={(e) => handleImageUpload(index, e.target.files[0])}
                  />
                </label>
              ))}
            </div>
          </section>

          {/* Buttons */}
          <div className="flex justify-between mt-6">
            <button
              type="button"
              className="border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-100"
            >
              ← Back
            </button>
            <button
              type="submit"
              disabled={loading || Object.values(errors).some(Boolean)}
              className="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 disabled:opacity-70"
            >
              {loading ? "Submitting..." : "Submit →"}
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default AddFutsalPage;
