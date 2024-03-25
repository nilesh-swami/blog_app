-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 04:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `mbrid` bigint(20) NOT NULL,
  `fname` varchar(250) DEFAULT NULL,
  `lname` varchar(250) DEFAULT NULL,
  `login_email` varchar(250) NOT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`mbrid`, `fname`, `lname`, `login_email`, `pwd`, `created_on`, `phone`) VALUES
(1, 'test', 'test', 'test@gmail.com', 'Test@123', '2024-03-24 15:14:46', ''),
(2, 'testt', 'testt', 'test2@gmail.com', 'Test@123', '2024-03-24 15:15:44', '7657657656');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` bigint(20) NOT NULL,
  `mbrid` bigint(20) DEFAULT NULL COMMENT 'Member id of who is created this post',
  `post_title` varchar(250) DEFAULT NULL COMMENT 'Post title',
  `post_desc` text DEFAULT NULL COMMENT 'Post description text',
  `post_status` varchar(50) DEFAULT NULL COMMENT 'The status one from following list:\nPublish\nPending\nDraft',
  `post_img_file_name` varchar(200) DEFAULT NULL,
  `post_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `mbrid`, `post_title`, `post_desc`, `post_status`, `post_img_file_name`, `post_date`) VALUES
(1, 1, 'My first post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod magna vel urna posuere, sit amet varius eros convallis. Sed ac velit sed nunc iaculis feugiat. Ut vitae elit a magna malesuada efficitur. Duis vehicula nulla non quam eleifend, vitae fermentum purus tempor. Morbi auctor dapibus urna, ac efficitur elit commodo vel. Vivamus at metus eget sapien faucibus laoreet. Integer nec urna sem. Sed malesuada vitae libero at volutpat. Sed ullamcorper felis sed purus pellentesque, at pharetra justo consequat. Quisque eget fringilla turpis. Phasellus malesuada, dui non tempor laoreet, lectus neque cursus urna, sit amet eleifend leo nisl sit amet turpis. Maecenas eget placerat dolor. Integer commodo orci et leo maximus, vitae vehicula libero aliquet. Sed pretium commodo nulla a pharetra. Vivamus nec ullamcorper elit. Nam sit amet neque ut metus tincidunt consectetur. Curabitur nec leo vitae mi volutpat dictum. Donec euismod, velit vitae sagittis tempus, est odio vehicula justo, nec feugiat est urna nec dolor. Sed quis justo vel tortor congue mattis. Sed bibendum elit non ex ultricies condimentum. Nullam eget nisi at libero auctor iaculis vel at enim. Nulla facilisi. In hac habitasse platea dictumst. Ut euismod bibendum dolor, sit amet feugiat nulla bibendum a. Sed vitae sapien tortor. Sed elementum convallis nulla. Sed et congue leo. Integer dictum enim quis quam placerat rutrum. Sed lacinia euismod ligula, in ullamcorper nunc congue sed. Phasellus tincidunt felis a ipsum vehicula, a fringilla ligula laoreet. Donec eget ipsum enim. Suspendisse sed vestibulum tortor. Suspendisse potenti. Donec lacinia tortor in aliquam faucibus. Maecenas nec lorem ac quam mollis fermentum. Sed suscipit nisl eu nulla tincidunt, eu ullamcorper elit sollicitudin. Integer tincidunt semper tortor, vel commodo odio suscipit id. Suspendisse feugiat, nunc non venenatis iaculis, justo justo mollis lacus, nec varius ex ex et nisi. Sed auctor purus et magna vestibulum aliquet. Phasellus fringilla tellus vitae tellus consequat, et lacinia mi accumsan. Phasellus bibendum ligula nec sapien hendrerit, eget efficitur leo vehicula. Cras eu felis non mi iaculis interdum. Vivamus congue sapien at risus lacinia, in vestibulum nulla commodo. Nullam dapibus commodo ante, eget cursus odio consequat a. Vivamus sed neque auctor, ultricies nisi a, mollis quam. Suspendisse potenti. Suspendisse potenti. Suspendisse potenti. Vivamus dignissim nulla quis nibh placerat, in finibus elit varius. Integer non elit auctor, mollis elit eu, venenatis purus. Donec non orci eget nibh venenatis tincidunt. Suspendisse potenti. Vivamus vehicula aliquet augue, at vehicula dui tempor vel. Donec dignissim dolor nunc, id ultricies justo vestibulum non. Suspendisse feugiat, arcu sit amet pharetra suscipit, enim sem scelerisque ligula, ut feugiat est eros vel magna. Donec vel posuere dolor. Maecenas sed sem id urna aliquam euismod. Vivamus in nulla ac libero suscipit rhoncus. Nam auctor tempor quam id auctor. Vivamus dapibus ultricies consequat. Donec congue urna non ex efficitur, eu accumsan neque posuere. Sed non efficitur lorem. Phasellus nec lorem eu lorem fermentum vehicula. Vivamus sit amet malesuada neque, auctor maximus ligula. Sed suscipit dolor sit amet nulla consectetur tincidunt. Cras nec lorem at turpis sollicitudin volutpat. Vivamus tincidunt odio eu leo vehicula, id vehicula tortor consequat. Ut consectetur, odio nec lacinia consequat, lorem sem fermentum velit, at malesuada odio felis vel mauris. Phasellus scelerisque dolor a nulla consequat vestibulum. Nullam varius sem sit amet lorem luctus, a bibendum dolor tincidunt. Sed eget fermentum eros. Ut non suscipit risus. Integer volutpat turpis nec nulla pellentesque, et venenatis risus sodales. Suspendisse potenti. Cras ullamcorper ligula eget velit vehicula, non convallis leo posuere. Suspendisse eu metus eget ipsum eleifend aliquet ac vel velit. Nulla facilisi. Suspendisse potenti. Suspendisse potenti. Ut tempus mi sed orci cursus, vitae maximus risus lacinia. In hac habitasse platea dictumst. Sed nec leo nec erat efficitur egestas eget ut nunc. In auctor, magna sit amet tempor tincidunt, nulla dui iaculis lectus, sit amet dapibus purus dolor sit amet felis. Maecenas hendrerit risus in libero dictum, a facilisis quam pellentesque. In hac habitasse platea dictumst. Ut eu erat vel ante eleifend tincidunt. Donec laoreet tincidunt eros, et commodo mauris gravida at. Sed id nisi in orci convallis auctor. Ut at vestibulum ipsum. Sed feugiat, est at molestie fermentum, risus tortor vehicula enim, eget fermentum orci nisl sit amet arcu. Curabitur dapibus, turpis in fermentum pulvinar, ex risus egestas justo, non dictum ligula tortor vel nunc. Integer nec aliquet sapien. Maecenas tristique vehicula magna, at scelerisque justo. In euismod tellus id scelerisque placerat. Sed eleifend purus at sapien condimentum, non accumsan eros scelerisque. Donec sit amet dui auctor, fermentum nisi vitae, viverra nunc. Integer aliquet enim id justo finibus, vitae volutpat risus feugiat. Donec a lectus a mi facilisis bibendum. Sed faucibus accumsan massa, vitae ultrices lacus pellentesque eget. Vivamus convallis convallis dolor, nec dignissim libero posuere nec. Sed fermentum justo id mi vehicula, sed sagittis purus tempor. Phasellus ac suscipit libero. Et', 'Publish', 'auspian-logo.png', '2024-03-24 15:36:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`mbrid`),
  ADD UNIQUE KEY `login_email_UNIQUE` (`login_email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `mbrid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
