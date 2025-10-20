import React, { useState } from "react";

const AddFutsalPage = () => {
  const [formData, setFormData] = useState({
    futsalName: "",
    phone: "",
    price: "",
    location: "",
    mapLink: "",
    aSide: "",
    grounds: "",
    amenities: [],
  });

  const [images, setImages] = useState(Array(5).fill(null));

  // handle input changes
  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };

  // handle checkbox toggle
  const handleAmenityChange = (e) => {
    const { value, checked } = e.target;
    setFormData((prev) => {
      const amenities = checked
        ? [...prev.amenities, value]
        : prev.amenities.filter((a) => a !== value);
      return { ...prev, amenities };
    });
  };

  // handle image uploads
  const handleImageUpload = (index, file) => {
    const newImages = [...images];
    newImages[index] = URL.createObjectURL(file);
    setImages(newImages);
  };

  // handle form submission
  const handleSubmit = (e) => {
    e.preventDefault();
    console.log("Submitted data:", formData);
    alert("Form submitted successfully!");
  };

  return (
    <div className="min-h-screen bg-gray-50 py-8 overflow-y-auto">
      <div className="max-w-3xl mx-auto bg-white rounded-2xl shadow p-8 mb-10">


        <form onSubmit={handleSubmit} className="space-y-10">
          {/* SECTION 1: Basic Info */}
          <section>
            <h2 className="text-2xl font-semibold text-green-700 mb-4">
              Basic Information
            </h2>
            <p className="text-gray-600 mb-6">
              Let's start with the essential details about your futsal.
            </p>

            <div className="space-y-4">
              <input
                name="futsalName"
                value={formData.futsalName}
                onChange={handleChange}
                placeholder="Enter futsal name"
                className="w-full border p-2 rounded-lg"
              />
              <input
                name="phone"
                value={formData.phone}
                onChange={handleChange}
                placeholder="Enter phone number (e.g. 9841234567)"
                className="w-full border p-2 rounded-lg"
              />
              <input
                name="price"
                type="number"
                value={formData.price}
                onChange={handleChange}
                placeholder="Enter price per hour (NPR)"
                className="w-full border p-2 rounded-lg"
              />
              <input
                name="location"
                value={formData.location}
                onChange={handleChange}
                placeholder="Enter location (e.g. Gyaneshwor, Kathmandu)"
                className="w-full border p-2 rounded-lg"
              />
              <input
                name="mapLink"
                value={formData.mapLink}
                onChange={handleChange}
                placeholder="Enter Google Maps link (https://goo.gl/maps/...)"
                className="w-full border p-2 rounded-lg"
              />
            </div>
          </section>

          {/* SECTION 2: Facilities */}
          <section>
            <h2 className="text-2xl font-semibold text-green-700 mb-4">
              Facilities & Features
            </h2>
            <p className="text-gray-600 mb-6">
              Tell us about the facilities and features of your futsal.
            </p>

            <div className="grid grid-cols-2 gap-4">
              <div>
                <label className="text-gray-700 font-medium">A-Side *</label>
                <input
                  name="aSide"
                  type="number"
                  value={formData.aSide}
                  onChange={handleChange}
                  placeholder="Enter number of players per side"
                  className="w-full border p-2 rounded-lg mt-1"
                />
              </div>
              <div>
                <label className="text-gray-700 font-medium">
                  Number of Grounds *
                </label>
                <input
                  name="grounds"
                  type="number"
                  value={formData.grounds}
                  onChange={handleChange}
                  placeholder="Enter number of grounds"
                  className="w-full border p-2 rounded-lg mt-1"
                />
              </div>
            </div>

            <p className="text-gray-500 mt-2 mb-4 text-sm">
              Number of players per side (e.g., 5 for 5-a-side)
            </p>

            <div className="grid grid-cols-2 sm:grid-cols-3 gap-2 mt-4">
              {[
                "Shower Facility",
                "Parking Space",
                "Changing Room",
                "Restaurant",
                "WiFi",
                "Open Ground",
              ].map((item, i) => (
                <label key={i} className="flex items-center gap-2">
                  <input
                    type="checkbox"
                    value={item}
                    onChange={handleAmenityChange}
                    checked={formData.amenities.includes(item)}
                  />
                  <span>{item}</span>
                </label>
              ))}
            </div>
          </section>

          {/* SECTION 3: Upload Images */}
          <section>
            <h2 className="text-2xl font-semibold text-green-700 mb-4">
              Upload Images
            </h2>
            <p className="text-gray-600 mb-6">
              Upload up to 5 high-quality images of your futsal.
            </p>

            <div className="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-4">
              {images.map((img, index) => (
                <label
                  key={index}
                  className="border-2 border-dashed rounded-lg flex flex-col items-center justify-center h-40 cursor-pointer hover:bg-gray-50"
                >
                  {img ? (
                    <img
                      src={img}
                      alt={`Upload ${index + 1}`}
                      className="h-full w-full object-cover rounded-lg"
                    />
                  ) : (
                    <div className="flex flex-col items-center text-gray-400">
                      <span className="text-4xl">🖼️</span>
                      <span>
                        {index === 0
                          ? "Upload Cover Image*"
                          : `Upload Image ${index + 1}`}
                      </span>
                    </div>
                  )}
                  <input
                    type="file"
                    accept="image/*"
                    className="hidden"
                    onChange={(e) =>
                      handleImageUpload(index, e.target.files[0])
                    }
                  />
                </label>
              ))}
            </div>

            <p className="text-gray-500 text-sm">
              First image will be used as the cover image. Recommended size:
              1200×800 pixels.
            </p>
          </section>

          {/* Buttons */}
          <div className="flex justify-between mt-8">
            <button
              type="button"
              className="flex items-center gap-1 border px-4 py-2 rounded-lg hover:bg-gray-100"
            >
              ← Back
            </button>
            <button
              type="submit"
              className="flex items-center gap-1 bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700"
            >
              Next →
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default AddFutsalPage;
