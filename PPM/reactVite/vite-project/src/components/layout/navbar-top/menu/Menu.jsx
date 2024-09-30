import PropTypes from "prop-types";
import { Link } from "react-router-dom";

function Menu({ menu }) {
  const listItems = menu.map((item) => (
    <li key={item.id} className="nav-item">
      <Link className="nav-link" to={item.href}>
        {item.name}
      </Link>
    </li>
  ));
  return <ul className="nav move">{listItems}</ul>;
}

export default Menu;

Menu.propTypes = {
  menu: PropTypes.array,
};
