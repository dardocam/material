import { BrowserRouter, Routes, Route } from "react-router-dom";
import Layout from "./components/layout/Layout";
import Home from "./components/home/Home";
import Login from "./components/login/Login";
import { useState, createContext } from "react";
export const UserContext = createContext();
function App() {
  const [user, setUser] = useState("Jesse Hall");
  const handleUser = (data) => {
    setUser(data);
  };
  return (
    <UserContext.Provider value={user}>
      <BrowserRouter>
        <Routes>
          <Route path="/" element={<Layout />}>
            <Route index element={<Home />} />
            <Route path="login" element={<Login handleUser={handleUser} />} />
            <Route path="*" element={<h1>Not found</h1>} />
          </Route>
        </Routes>
      </BrowserRouter>
    </UserContext.Provider>
  );
}

export default App;
