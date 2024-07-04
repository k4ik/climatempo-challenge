import logo from '../assets/images/logo.png';

function Header() {
	return (
		<header className="bg-blue-600 h-16 flex justify-center items-center">
			<img src={logo} alt="logo" className="w-56 select-none" />
		</header>
	)
}


export default Header