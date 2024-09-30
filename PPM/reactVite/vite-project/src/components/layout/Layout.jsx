import { Outlet } from "react-router-dom";
import NavBarTop from "./navbar-top/NavBarTop";

function Layout() {
  return (
    <>
      <NavBarTop />
      <Outlet />
    </>
  );
}

export default Layout;
