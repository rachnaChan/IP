const items = require("../models/items");

const findById = async (id) => {
  const result = await items.findById(id);
  try {
    return {
      success: true,
      data: result,
    };
  } catch (err) {
    return {
      success: false,
      error: err || "error",
    };
  }
};

const findAll = async () => {
  return await items.aggregate([
    {
      $lookup: {
        from: "items",
        localField: "_id",
        foreignField: "category",
        as: "items",
      },
    },
  ]);
};

const created = async (newItem) => {
  // to do
  const createdItem = await items.create(newItem);
  
  return createdItem;
};

const updated = async (req, res) => {
  // to do

  const { id, name, desc, imageUrl } = req.body;
  //console.log(id)
  try {
    const doc = await items.findById(id);
    //update data
    doc.name = name;
    doc.desc = desc;
    doc.imageUrl = imageUrl;
    await doc.save();
    res.json({ success: true, data: doc });

  } catch (error) {
    res.json({ success: false, error: error });
  }
};

const removed = async (res, req) => {
  // to do
  const { id } = req.params;

  console.log(id);
  try {
    const deleted = await items.deleteOne({ _id: id });

    console.log("deleted", deleted);

    res.json({ success: true, data: deleted });
  } catch (error) {
    res.json({ success: false, error: error });
  }
};

module.exports = {
  findById,
  updated,
  removed,
  findAll,
  created,
};
