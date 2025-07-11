export const errorHandler = (req, res) => {
  // Enable JSON body parsing
  if (!req.body) {
    return res.status(400).json({ error: "Request body is required" });
  }
  
  if (!req.body.error) {
    return res.status(500).json({ error: "Internal Server Error" });
  }
  
  return res.status(400).json({ 
    error: req.body.error 
  });
};