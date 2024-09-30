import { Route, Routes } from "react-router-dom";

export const AppRouter = () => {
  return (
    <Routes>
      <Route path="/" element={<h1>home</h1>} errorElement={<h1>ERROR</h1>} />

      <Route path="/login" element={<h1>login</h1>} />
    </Routes>
  );
};
