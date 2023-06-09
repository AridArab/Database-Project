/****** Object:  Database [UMADATABASE_TEAM6]    Script Date: 4/23/2023 5:14:56 PM ******/
CREATE DATABASE [UMADATABASE_TEAM6]  (EDITION = 'Standard', SERVICE_OBJECTIVE = 'S0', MAXSIZE = 250 GB) WITH CATALOG_COLLATION = SQL_Latin1_General_CP1_CI_AS, LEDGER = OFF;
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET COMPATIBILITY_LEVEL = 150
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET ARITHABORT OFF 
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET ALLOW_SNAPSHOT_ISOLATION ON 
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET READ_COMMITTED_SNAPSHOT ON 
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET  MULTI_USER 
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET ENCRYPTION ON
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET QUERY_STORE = ON
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET QUERY_STORE (OPERATION_MODE = READ_WRITE, CLEANUP_POLICY = (STALE_QUERY_THRESHOLD_DAYS = 30), DATA_FLUSH_INTERVAL_SECONDS = 900, INTERVAL_LENGTH_MINUTES = 60, MAX_STORAGE_SIZE_MB = 100, QUERY_CAPTURE_MODE = AUTO, SIZE_BASED_CLEANUP_MODE = AUTO, MAX_PLANS_PER_QUERY = 200, WAIT_STATS_CAPTURE_MODE = ON)
GO
/*** The scripts of database scoped configurations in Azure should be executed inside the target database connection. ***/
GO
-- ALTER DATABASE SCOPED CONFIGURATION SET MAXDOP = 8;
GO
/****** Object:  User [Xaviertwo]    Script Date: 4/23/2023 5:14:56 PM ******/
CREATE USER [Xaviertwo] FOR LOGIN [Xaviertwo] WITH DEFAULT_SCHEMA=[dbo]
GO
/****** Object:  User [Quang]    Script Date: 4/23/2023 5:14:56 PM ******/
CREATE USER [Quang] FOR LOGIN [Quang] WITH DEFAULT_SCHEMA=[dbo]
GO
/****** Object:  User [Donesh]    Script Date: 4/23/2023 5:14:56 PM ******/
CREATE USER [Donesh] FOR LOGIN [Donesh] WITH DEFAULT_SCHEMA=[dbo]
GO
sys.sp_addrolemember @rolename = N'db_owner', @membername = N'Xaviertwo'
GO
sys.sp_addrolemember @rolename = N'db_owner', @membername = N'Quang'
GO
sys.sp_addrolemember @rolename = N'db_owner', @membername = N'Donesh'
GO
/****** Object:  Table [dbo].[Employee]    Script Date: 4/23/2023 5:14:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Employee](
	[First_Name] [varchar](50) NOT NULL,
	[Last_Name] [varchar](50) NOT NULL,
	[Middle_Initial] [varchar](1) NULL,
	[Birthday] [date] NOT NULL,
	[City] [varchar](50) NOT NULL,
	[State] [varchar](50) NOT NULL,
	[Zip_Code] [int] NOT NULL,
	[Street_Address] [varchar](50) NOT NULL,
	[Salary] [int] NULL,
	[Sex] [varchar](50) NOT NULL,
	[Phone_Number] [nchar](10) NOT NULL,
	[Email_Address] [varchar](50) NOT NULL,
	[Department_ID] [int] NULL,
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[Password] [varchar](max) NOT NULL,
	[Is_Manager] [int] NOT NULL,
 CONSTRAINT [PK_Employee] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  View [dbo].[employees1]    Script Date: 4/23/2023 5:14:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create view [dbo].[employees1] as select * from Employee
GO
/****** Object:  Table [dbo].[Department]    Script Date: 4/23/2023 5:14:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Department](
	[Phone_Number] [int] NOT NULL,
	[Dept_Name] [varchar](50) NOT NULL,
	[Email_Address] [varchar](50) NOT NULL,
	[Dept_budget] [int] NOT NULL,
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[Manager_ID] [int] NULL,
	[isActive] [int] NULL,
 CONSTRAINT [PK_Department] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Dept_Locations]    Script Date: 4/23/2023 5:14:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Dept_Locations](
	[Street_Address] [varchar](50) NOT NULL,
	[City] [varchar](50) NOT NULL,
	[State] [varchar](50) NOT NULL,
	[Zip_Code] [int] NOT NULL,
	[Department_ID] [int] NOT NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Logs]    Script Date: 4/23/2023 5:14:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Logs](
	[LogID] [int] IDENTITY(1,1) NOT NULL,
	[Message] [nvarchar](50) NOT NULL,
	[Project_ID] [int] NOT NULL,
	[isActive] [int] NOT NULL,
	[Date_Logged] [datetime] NOT NULL,
 CONSTRAINT [PK_Logs] PRIMARY KEY CLUSTERED 
(
	[LogID] ASC
)WITH (STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Message]    Script Date: 4/23/2023 5:14:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Message](
	[MessageID] [int] IDENTITY(1,1) NOT NULL,
	[Message] [nvarchar](150) NOT NULL,
	[RecipientID] [int] NOT NULL,
	[Date_Sent] [date] NOT NULL,
	[isActive] [int] NULL,
 CONSTRAINT [PK_Message] PRIMARY KEY CLUSTERED 
(
	[MessageID] ASC
)WITH (STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Project]    Script Date: 4/23/2023 5:14:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Project](
	[Progress] [int] NULL,
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[Name] [varchar](50) NOT NULL,
	[Total_Cost] [int] NULL,
	[Street_Address] [varchar](50) NOT NULL,
	[City] [varchar](50) NOT NULL,
	[State] [varchar](50) NULL,
	[Zip_Code] [int] NOT NULL,
	[Department_ID] [int] NULL,
	[Budget] [int] NULL,
	[isActive] [int] NULL,
	[Start_Date] [date] NULL,
	[End_Date] [date] NULL,
	[Deadline] [date] NULL,
 CONSTRAINT [PK_Project] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Transactions]    Script Date: 4/23/2023 5:14:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Transactions](
	[Project_ID] [int] NOT NULL,
	[Department_ID] [int] NOT NULL,
	[Amount] [int] NOT NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[WORKS_ON]    Script Date: 4/23/2023 5:14:57 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[WORKS_ON](
	[Job_Title] [varchar](50) NOT NULL,
	[Start_Date] [date] NOT NULL,
	[End_Date] [date] NULL,
	[Total_Hours] [int] NULL,
	[Employee_ID] [int] NOT NULL,
	[Project_ID] [int] NOT NULL,
	[Description] [text] NULL,
	[Progress] [int] NULL,
	[Deadline] [date] NOT NULL,
	[ID] [int] IDENTITY(1,1) NOT NULL,
 CONSTRAINT [PK_WORKS_ON] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[Department] ON 

INSERT [dbo].[Department] ([Phone_Number], [Dept_Name], [Email_Address], [Dept_budget], [ID], [Manager_ID], [isActive]) VALUES (9876543, N'Feel Good Inc', N'goodvibes@gmail.com', 52000, 6, 15, 1)
INSERT [dbo].[Department] ([Phone_Number], [Dept_Name], [Email_Address], [Dept_budget], [ID], [Manager_ID], [isActive]) VALUES (45689712, N'Monsters Inc', N'cras.vulputate@aol.edu', 80000, 8, 14, 1)
INSERT [dbo].[Department] ([Phone_Number], [Dept_Name], [Email_Address], [Dept_budget], [ID], [Manager_ID], [isActive]) VALUES (1111111112, N'Joker INC', N'demo@generic.com', 50000, 9, 15, 0)
INSERT [dbo].[Department] ([Phone_Number], [Dept_Name], [Email_Address], [Dept_budget], [ID], [Manager_ID], [isActive]) VALUES (1111111111, N'The Cool Guys', N'genericmail@generic.com', 50000, 10, 15, 0)
INSERT [dbo].[Department] ([Phone_Number], [Dept_Name], [Email_Address], [Dept_budget], [ID], [Manager_ID], [isActive]) VALUES (1111111111, N'The Cool Guys', N'genericmail@generic.com', 50000, 11, 15, 0)
INSERT [dbo].[Department] ([Phone_Number], [Dept_Name], [Email_Address], [Dept_budget], [ID], [Manager_ID], [isActive]) VALUES (1111111111, N'The Cool Guys', N'genericmail@generic.com', 50000, 12, 15, 0)
INSERT [dbo].[Department] ([Phone_Number], [Dept_Name], [Email_Address], [Dept_budget], [ID], [Manager_ID], [isActive]) VALUES (888555222, N'Database Squad', N'databasesquad@gmail.com', 100000, 15, 81, NULL)
SET IDENTITY_INSERT [dbo].[Department] OFF
GO
INSERT [dbo].[Dept_Locations] ([Street_Address], [City], [State], [Zip_Code], [Department_ID]) VALUES (N'5091 Block Avenue', N'Houston', N'TX', 77414, 6)
INSERT [dbo].[Dept_Locations] ([Street_Address], [City], [State], [Zip_Code], [Department_ID]) VALUES (N'10923 James Pkwy', N'Spring', N'TX', 77373, 8)
INSERT [dbo].[Dept_Locations] ([Street_Address], [City], [State], [Zip_Code], [Department_ID]) VALUES (N'123 street', N'Sugar Land', N'TX', 77494, 9)
INSERT [dbo].[Dept_Locations] ([Street_Address], [City], [State], [Zip_Code], [Department_ID]) VALUES (N'912 Database street', N'Houston', N'TX', 77207, 15)
GO
SET IDENTITY_INSERT [dbo].[Employee] ON 

INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JOHNNY', N'JACKSON', N'J', CAST(N'1970-01-01' AS Date), N'HOUSTON', N'TX', 22222, N'123 RD', 15000, N'MALE', N'9999999999', N'bobbyjackson@gmail.com', 8, 14, N'$2y$10$seJlxa2X3kRAmaodr6opCuWWymJMvFiylLCfbgZ5ydq12ZOWyHMrG', 2)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'BOB', N'JONES', N'K', CAST(N'1973-08-09' AS Date), N'HOUSTON', N'TX', 11111, N'123 ROAD RD', 10000, N'MALE', N'9999999999', N'bobjones@gmail.com', 6, 15, N'$2y$10$6zjH4o8wgtg9LUrd9tK/5eGlNo/usdbVCFE566Q/RedLnAbfwabPu', 1)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'MARIA', N'SMITH', N'C', CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'123 ROAD RD', 75000, N'FEMALE', N'9999999999', N'mariasmith@gmail.com', 8, 22, N'$2y$10$aU2yMJMuFsQbPmnetBrGGuR3qRC8Cwr4MJ6l1JGR.xjJpZ5WAyKJS', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JOHN', N'SMITH', N'F', CAST(N'1985-03-25' AS Date), N'HOUSTON', N'TX', 11111, N'123 ROAD', 10000, N'MALE', N'9999999999', N'johnsmith@gmail.com', 6, 25, N'$2y$10$QdrMA8prFsXRn0KYVNfFgOiTJnOvLqg8Tg0QXFOiE1qeYiHMNyn0q', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JOHN', N'DOE', N'B', CAST(N'1973-08-09' AS Date), N'HOUSTON', N'TX', 55555, N'123 ROAD RD', 10000, N'MALE', N'9999999999', N'johndoe@gmail.com', 8, 27, N'$2y$10$rG2M0R5KpZA8h0E1TDG6b..zOtDbMZo5AlXKnBbPU2aNkHcOy143S', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'RANDELL', N'PAUL', N'A', CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'123 ROAD RD', 10000, N'MALE', N'9999999999', N'randellpaul@gmail.com', NULL, 28, N'$2y$10$JXYnXdE1wfu5VlQHfgjj5OjDTMwDHIbP3DwrPSCQjbv5101brCnzO', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'SARAH', N'WILLIAMS', NULL, CAST(N'1973-08-09' AS Date), N'HOUSTON', N'TX', 55555, N'123 ROAD RD', 10000, N'FEMALE', N'9999999999', N'sarahwilliams@gmail.com', NULL, 30, N'$2y$10$aCsKSCVq3PZTcU7GYAWM2On84/XcJAql.2MhA7dOppCRQP0vgTQrW', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'MIKE', N'RIZZZOWLSKI', N'R', CAST(N'1999-08-12' AS Date), N'DALLAS', N'TX', 45613, N'324 SOUTH STREET', 10000, N'MALE', N'9999999999', N'therizzler@gmail.com', 8, 32, N'$2y$10$aSRfNy66UBYk9NqEmy4fkuD2j631lBJJiMjJF0gZXNK86BoPT1dNW', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'MARIA', N'PAUL', NULL, CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'123 ROAD RD', 10000, N'FEMALE', N'9999999999', N'mariapaul@gmail.com', NULL, 33, N'$2y$10$QRNSNXZThefil50fn.8bYeoxzSib9xigh/8sXLujKZds4RK6r4w66', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'SARAH', N'SMITH', N'H', CAST(N'1973-08-09' AS Date), N'HOUSTON', N'TX', 11111, N'123 ROAD RD', 10000, N'FEMALE', N'9999999999', N'johnpaul@gmail.com', 8, 34, N'$2y$10$9FwFFxKeewU5rH33Kxot3.GpMCoW.nKhlM1Hc6HMh2gIyOyo.YN22', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'MARIA', N'DOE', NULL, CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'123 ROAD RD', 90000, N'FEMALE', N'9999999999', N'mariadoe@gmail.com', 8, 35, N'$2y$10$H7VyYcm4hBCQ2AS3/EmY8uzaOWqe4zZ7TnzNTPyDsj4ew0MITY9oG', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'BOB', N'JONES', N'A', CAST(N'1990-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'123 ROAD RD', 10000, N'MALE', N'9999999999', N'bobjones@gmail.com', NULL, 36, N'$2y$10$2SCE8Pme9j6KlL4O8MxD6.fvrVOnNFYSJHh6VaOCilhAi2DxXnBv2', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'FRANK', N'JONES', N'A', CAST(N'1980-05-12' AS Date), N'HOUSTON', N'TX', 11111, N'123 TREE RD', 10000, N'MALE', N'9999999999', N'frankjones@gmail.com', NULL, 37, N'$2y$10$nuquXjMUtmQZ93.oHlqPMO.0UYKDc7L2Dr75xKz.1uaFT/jK.4/Tm', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JOHN', N'WILLIAMS', NULL, CAST(N'1973-08-09' AS Date), N'HOUSTON', N'TX', 11111, N'123 ROAD RD', 10000, N'MALE', N'9999999999', N'johnsmith@gmail.com', NULL, 38, N'$2y$10$MnnkUtQXDHcW6PAmp.a9Xurb.5iZzF0w2IVbsQkG1t4Ql94jsn8km', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JOHN', N'FRANK', NULL, CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'123 TREE RD', 10000, N'MALE', N'9999999999', N'johnfrank@gmail.com', NULL, 39, N'$2y$10$HFSyXwTHrgpMqntI.X5ieuoVTo9nidz147trabpibX3t1S6gE2fba', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'SARAH', N'PARK', NULL, CAST(N'1973-08-09' AS Date), N'HOUSTON', N'TX', 11111, N'123 ROAD RD', 10000, N'FEMALE', N'9999999999', N'sarahpark@gmail.com', NULL, 40, N'$2y$10$U2IVxkAQu9TwOKxieChnG.MS6sAyJqQDAUrhHiQHsTiE/FSONcFgq', 1)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JACKSON', N'MICHAEL', N'Y', CAST(N'1970-08-08' AS Date), N'HOUSTON', N'TX', 11111, N'111 STREET ST', 10000, N'MALE', N'9999999999', N'jacksonmichael@gmail.com', NULL, 41, N'$2y$10$eeALVq8WU8IQb8RXvReM8Ord7EmpLOXCLgPeNGv1pD/uIj0LUBHIW', 1)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'MARIA', N'SMITH', NULL, CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'123 ROAD RD', 10000, N'FEMALE', N'9999999999', N'mariasmith@gmail.com', NULL, 42, N'$2y$10$c48kh/bZ1g8bHiOHEcqAuuR2wIifB7kzRKvss7M1yYOTQ5F1pkxuS', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JOHN', N'DOE', NULL, CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'111 ROAD RD', 10000, N'MALE', N'9999999999', N'johndoe@gmail.com', NULL, 43, N'$2y$10$O0GfeV.aPZPyIcx81rcVqentpMEyXJ4/MSbdQMI1KUv9kMQ4uP3zu', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'ALEX', N'MICHAELS', NULL, CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'111 ROAD RD', 10000, N'MALE', N'9999999999', N'alexmichaels@gmail.com', NULL, 44, N'$2y$10$JmjlHPuMMgt165IBtV/eR.obZ63HOH.bBv1DqCDElWXMBNZdc4Q/i', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JACKA', N'RIDERA', N'F', CAST(N'2022-05-07' AS Date), N'CITYA', N'STATEA', 11112, N'123 STREET STREET', 10000, N'MALE', N'9999999999', N'genericmail@generic.com', NULL, 47, N'$2y$10$1.aM/hv5gGCTf6zE3f9PzuKN.hS4umNDVmYH6gNOtzL8EQzRfJk/q', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'SOPHIA', N'KIM', N'L', CAST(N'1991-07-05' AS Date), N'Miami', N'FL', 33101, N'345 Maple Ave', 78000, N'FEMALE', N'1111111111', N'kimsophia@gmail.com', 6, 48, N'password1819', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'SAM', N'DUDE', N'I', CAST(N'2022-04-05' AS Date), N'CITY', N'STATE', 11111, N'STREET', 10000, N'MALE', N'9999999999', N'genericmail@generic.com', NULL, 50, N'$2y$10$c8gaTgqf1Fk8iwOGF9hVPO/ciQKcIm8LS6goB3WaS4NgxNTG4vy02', 1)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'GARY', N'JORDAN', NULL, CAST(N'1999-08-20' AS Date), N'SAN FANCISCO', N'CALIFORNIA', 88889, N'202 QUARTER LANE', 10000, N'MALE', N'9999999999', N'newemail@example.com', NULL, 53, N'$2y$10$EUYS24yyn5PGokplMdT8ue4xQup78X9tgH/1.LRsmpcHn6l50ArPe', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JOHN', N'STANLEY', NULL, CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'111 ROAD RD', 10000, N'MALE', N'9999999999', N'johnstanley@gmail.com', 8, 67, N'$2y$10$T82DEyyYnjeWiun1EtgmruAnNsRk5/qNR7MML37bxETl7xn87Oj3C', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JOHN', N'TRISTAN', N'C', CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'111 ROAD RD', 10000, N'MALE', N'9999999999', N'johntristan@gmail.com', NULL, 68, N'$2y$10$.sL6W3gCUps/q3fXDEOxZedqB0Hmp9czuQBJyFNeqsNieNlP49Vg.', 1)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'ALEX', N'JOHN', NULL, CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'111 ROAD RD', 10000, N'MALE', N'9999999999', N'alexjohn@gmail.com', NULL, 69, N'$2y$10$BgJ4GgHTYBj9lU6anl1jneOY3ZI/q6pqMbwHxEJGrwmT5ChMaT5y2', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'GERALD', N'MITCH', NULL, CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'111 ROAD RD', 10000, N'MALE', N'9999999999', N'geraldmitch@gmail.com', NULL, 72, N'$2y$10$G2b9nLn9wSvuHVfN01O89e3fThKoDSuA3y9KjGUvr3Za0NzQer5Q2', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'GERALD', N'MICHAELS', NULL, CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'111 ROAD RD', 10000, N'OTHER', N'9999999999', N'geraldmichaels@gmail.com', NULL, 75, N'$2y$10$LFwvpDcRZ7Aiq6fwbDPvoOj0xdiUTmn3cOIjyooaxdr.yMo82M/5m', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'ALEX', N'STANLEY', NULL, CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'111 ROAD RD', 10000, N'OTHER', N'9999999999', N'alexstanley@gmail.com', 8, 77, N'$2y$10$IQzCDkWhQqcvUWbZJ2gwV.kew01rOFK1.VN15JEcgvz7IEl6iRKcK', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'URIEL', N'HOUSE', NULL, CAST(N'1900-01-01' AS Date), N'HOUSTON', N'TEXAS', 11111, N'111 ROAD RD', 10000, N'MALE', N'9999999999', N'uh@gmail.com', 8, 79, N'$2y$10$FZkngpPdW0FOUIJUNz6/jeND/LZThP8xSO7xqGcdpoBpk.NPT27IW', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JOHN', N'SMITH', NULL, CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'111 ROAD RD', 10000, N'MALE', N'9999999999', N'johndoe@gmail.com', 8, 81, N'$2y$10$0IMS2TGeenbpjsPTNuG5duGKCbe8dm/956LCDahZ3ErqEF0/0YZTa', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JOHN', N'SMITH', NULL, CAST(N'2001-01-01' AS Date), N'HOUSTON', N'TEXAS', 11111, N'111 ROAD RD', 10000, N'MALE', N'9999999999', N'johndoe@gmail.com', 8, 82, N'$2y$10$CMjplJA9kukC9jxhoLIFXOZt8ZMwOq1yzJ8ub0QBfpLJjYRAEj9Lm', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'G', N'G', NULL, CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'STREET', 10000, N'MALE', N'9999999999', N'mail@mail.com', 8, 83, N'$2y$10$IzG049o0W0Qwo7tN9bbmsefHMQyaEQylSXsO3m/HRk6m1Q0.9X0wK', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JOHN', N'DOE', N'K', CAST(N'1990-05-15' AS Date), N'Houston', N'TX', 77001, N'123 Main St', 50000, N'male', N'9999999999', N'doejohn@gmail.com', 8, 101, N'password123', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JANE', N'SMITH', N'M', CAST(N'1985-12-10' AS Date), N'Austin', N'TX', 78701, N'456 Elm St', 75000, N'female', N'9999999999', N'smithjane@gmail.com', 6, 102, N'password456', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'ALEX', N'LEE', N'W', CAST(N'1995-07-20' AS Date), N'Dallas', N'TX', 75201, N'789 Oak St', 60000, N'other', N'9999999999', N'leealex@gmail.com', 8, 103, N'password789', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'W', N'W', NULL, CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'TILTED TOWERS', 10000, N'MALE', N'1111111111', N'johndoe@gmail.com', NULL, 104, N'$2y$10$keot55ii0AeN0WUdmzs0kes0zKIa6dv4oLqqC.XE0LkDuUOrfmYCu', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'W', N'W', NULL, CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'TILTED TOWERS', 10000, N'MALE', N'1111111111', N'johndoe@gmail.com', NULL, 105, N'$2y$10$F905IdEgJi9j1lT8Fmwr/uXY4q9U34hn2OoEbRjbupAr5K84M9R7S', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JESSICA', N'LEE', N'S', CAST(N'1990-01-01' AS Date), N'New York', N'NY', 10001, N'123 Main St', 80000, N'FEMALE', N'1111111111', N'leejessica@gmail.com', 8, 111, N'password123', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'MICHAEL', N'KIM', N'H', CAST(N'1992-05-10' AS Date), N'Los Angeles', N'CA', 90001, N'456 Oak St', 70000, N'MALE', N'1111111111', N'kimmichael@gmail.com', 6, 122, N'password456', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'DAVID', N'YANG', N'J', CAST(N'1985-12-15' AS Date), N'Chicago', N'IL', 60601, N'789 Maple Ave', 90000, N'MALE', N'1111111111', N'yangdavid@gmail.com', 8, 143, N'password789', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JOHN', N'KANG', N'S', CAST(N'1988-06-30' AS Date), N'Seattle', N'WA', 98101, N'101 Main St', 85000, N'MALE', N'1111111111', N'kangjohn@gmail.com', 8, 165, N'password1213', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JENNIFER', N'LEE', N'M', CAST(N'1993-09-20' AS Date), N'San Francisco', N'CA', 94101, N'567 Pine St', 75000, N'FEMALE', N'1111111111', N'leejennifer@gmail.com', 6, 174, N'password1011', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'EMILY', N'PARK', N'W', CAST(N'1994-03-25' AS Date), N'Boston', N'MA', 2101, N'234 Oak St', 72000, N'FEMALE', N'1111111111', N'parkemily@gmail.com', 6, 176, N'password1415', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'RYAN', N'LEE', N'G', CAST(N'1989-04-12' AS Date), N'Dallas', N'TX', 75201, N'567 Oak St', 87000, N'MALE', N'1111111111', N'leeryan@gmail.com', 8, 189, N'password2021', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'SARAH', N'YANG', N'L', CAST(N'1993-11-17' AS Date), N'Los Angeles', N'CA', 90001, N'4567 Maple St', 55000, N'female', N'1111111111', N'yangsarah@gmail.com', 6, 201, N'password123', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'ANDREW', N'NGUYEN', N'Q', CAST(N'1992-02-28' AS Date), N'San Francisco', N'CA', 94101, N'789 Oak St', 70000, N'male', N'1111111111', N'nguyenandrew@gmail.com', 8, 202, N'password456', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JESSICA', N'KIM', N'H', CAST(N'1991-09-03' AS Date), N'New York', N'NY', 10001, N'123 Main St', 60000, N'female', N'1111111111', N'kimjessica@gmail.com', 6, 203, N'password789', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'DAVID', N'WANG', N'T', CAST(N'1989-06-22' AS Date), N'Seattle', N'WA', 98101, N'4567 Elm St', 65000, N'male', N'1111111111', N'wangdavid@gmail.com', 8, 204, N'password234', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'KRISTINA', N'LEE', N'S', CAST(N'1995-12-15' AS Date), N'Boston', N'MA', 2101, N'789 Maple St', 50000, N'female', N'1111111111', N'leekristina@gmail.com', 6, 205, N'password567', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'MICHAEL', N'KIM', N'J', CAST(N'1990-08-01' AS Date), N'Chicago', N'IL', 60601, N'123 Oak St', 75000, N'male', N'1111111111', N'kimmichael@gmail.com', 8, 206, N'password890', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'SOPHIA', N'ZHANG', N'M', CAST(N'1994-05-20' AS Date), N'Houston', N'TX', 77001, N'4567 Main St', 45000, N'female', N'1111111111', N'zhangsophia@gmail.com', 6, 207, N'password123', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'NICHOLAS', N'LI', N'H', CAST(N'1993-02-14' AS Date), N'San Diego', N'CA', 92101, N'789 Elm St', 80000, N'male', N'1111111111', N'linicholas@gmail.com', 8, 208, N'password456', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'EMILY', N'KIM', N'Y', CAST(N'1988-12-05' AS Date), N'Washington DC', N'DC', 20001, N'123 Maple St', 70000, N'female', N'1111111111', N'kimemily@gmail.com', 6, 209, N'password789', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'DANIEL', N'CHOI', N'S', CAST(N'1996-01-30' AS Date), N'Atlanta', N'GA', 30301, N'4567 Oak St', 55000, N'male', N'1111111111', N'choidaniel@gmail.com', 8, 210, N'password234', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JOHN', N'DOE', NULL, CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'111 ROAD RD', 10000, N'OTHER', N'1111111111', N'johndoe@gmail.com', 8, 211, N'$2y$10$55PqXDEh7WmBzOwmQKd0Q.SDW2JanxmpYhVzszg0HanT9XSXo.Lua', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'DANIEL', N'CHOI', N'K', CAST(N'1987-11-03' AS Date), N'Houston', N'TX', 77001, N'789 Elm St', 95000, N'MALE', N'1111111111', N'choidaniel@gmail.com', 8, 327, N'password1617', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'BOBBY', N'E', NULL, CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'STREET', 10000, N'MALE', N'9999999999', N'mail@mail.com', 8, 328, N'$2y$10$7Q0t4qT/iqNY7Yx3gL2/ButwO2qFRoHvovVSokGxLPfopbjO0wLiO', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JACK', N'BOBBY', NULL, CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 77777, N'123 STREET', 15000, N'MALE', N'1111111111', N'js@gmail.com', 8, 329, N'$2y$10$Lsq37ehkgEK7rkrbmqVLTedRWcNuaOp2g5jQ87kZ2Qro/X08raktS', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'BOB', N'SMITH', NULL, CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'123 STREET', 9000, N'MALE', N'1111111111', N'bobjones@gmail.com', 8, 330, N'$2y$10$qiDMIs0u1VeTNhIHB/4NbOCKKokZHNelfG.yqPdc94ovQbhFn5U5m', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JOHN', N'SMITH', NULL, CAST(N'2000-01-01' AS Date), N'HOUSTON', N'TX', 11111, N'123 STREET', 5000, N'MALE', N'1111111111', N'jj@gmail.com', 8, 331, N'$2y$10$rgWPtnWoatQ7p4Sicw/DVuOVSOJX.9l8gNRpsT95PyWixhYlly2aK', 0)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'JULIUS', N'CASTELLANO', N'X', CAST(N'1999-03-24' AS Date), N'SUGAR LAND', N'TEXAS', 77461, N'413 OAK STREET', 10000, N'MALE', N'5489785219', N'jcastellano@gmail.com', NULL, 332, N'$2y$10$S0jRjJGMiLuM9HSK.c.DO.uaEhJiHO94jViptLSCHc0DfClyPnoNW', 1)
INSERT [dbo].[Employee] ([First_Name], [Last_Name], [Middle_Initial], [Birthday], [City], [State], [Zip_Code], [Street_Address], [Salary], [Sex], [Phone_Number], [Email_Address], [Department_ID], [ID], [Password], [Is_Manager]) VALUES (N'KEEAN', N'SMITH', N'D', CAST(N'1999-12-21' AS Date), N'RICHMOND', N'TX', 77407, N'6106 HACKBERRY BRANCH LN', 10000, N'MALE', N'9018271744', N'keeansmith@rocketmail.com', NULL, 333, N'$2y$10$N8Spf1cpd/s2D2Ob6DswguemWXaVYALdMON9ZkxacYOiGBEfgFEIW', 0)
SET IDENTITY_INSERT [dbo].[Employee] OFF
GO
SET IDENTITY_INSERT [dbo].[Logs] ON 

INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (1, N'Warning project over budget!', 123, 0, CAST(N'2023-04-03T20:25:03.893' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (3, N'Project Completed!', 318, 0, CAST(N'2023-04-03T21:18:48.897' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (4, N'Warning project over budget!', 451, 0, CAST(N'2023-04-04T16:56:49.580' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (5, N'Project Completed!', 123, 0, CAST(N'2023-04-04T20:45:12.827' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (6, N'Project value updated!', 333, 0, CAST(N'2023-04-05T15:58:13.220' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (7, N'Project Completed!', 318, 0, CAST(N'2023-04-07T04:12:13.367' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (12, N'Project Completed!', 546, 0, CAST(N'2023-04-08T20:47:22.480' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (13, N'Project value updated!', 254, 0, CAST(N'2023-04-08T21:32:25.900' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (15, N'Project value updated!', 451, 0, CAST(N'2023-04-08T21:35:59.167' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (16, N'Project value updated!', 333, 0, CAST(N'2023-04-08T22:29:36.210' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (17, N'Project value updated!', 333, 0, CAST(N'2023-04-08T22:30:21.730' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (18, N'Project value updated!', 333, 0, CAST(N'2023-04-08T22:30:39.747' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (19, N'Project value updated!', 333, 0, CAST(N'2023-04-08T22:30:52.030' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (20, N'Project value updated!', 333, 0, CAST(N'2023-04-08T22:31:06.780' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (21, N'Project value updated!', 541, 0, CAST(N'2023-04-08T22:49:50.143' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (22, N'Project value updated!', 541, 0, CAST(N'2023-04-09T06:17:39.617' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (23, N'Project value updated!', 254, 0, CAST(N'2023-04-09T06:21:46.710' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (24, N'Project Completed!', 532, 0, CAST(N'2023-04-10T01:43:34.690' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (25, N'Project value updated!', 8569, 0, CAST(N'2023-04-10T08:21:35.537' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (26, N'Project value updated!', 8569, 0, CAST(N'2023-04-10T08:24:52.443' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (27, N'Project value updated!', 8569, 0, CAST(N'2023-04-10T08:32:52.697' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (28, N'Project value updated!', 8569, 0, CAST(N'2023-04-10T08:33:17.980' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (29, N'Project value updated!', 8569, 0, CAST(N'2023-04-10T08:33:48.480' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (31, N'Project Completed!', 8569, 0, CAST(N'2023-04-10T08:56:20.543' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (33, N'Project value updated!', 23, 0, CAST(N'2023-04-10T19:37:23.980' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (34, N'Project value updated!', 79, 0, CAST(N'2023-04-10T19:37:24.000' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (36, N'Project Completed!', 21, 0, CAST(N'2023-04-10T20:12:55.750' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (37, N'Project Completed!', 21, 0, CAST(N'2023-04-10T20:28:26.117' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (38, N'Project Completed!', 451, 0, CAST(N'2023-04-10T20:28:55.070' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (39, N'Project Completed!', 5557, 0, CAST(N'2023-04-10T20:29:16.740' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (40, N'Project Completed!', 1234, 0, CAST(N'2023-04-10T20:44:50.823' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (41, N'Project value updated!', 246, 0, CAST(N'2023-04-10T20:47:43.730' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (42, N'Warning project over budget!', 23, 0, CAST(N'2023-04-11T16:51:36.080' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (43, N'Warning project over budget!', 23, 0, CAST(N'2023-04-11T17:22:53.680' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (44, N'Street Address Updated!', 23, 0, CAST(N'2023-04-11T17:22:53.680' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (45, N'Total cost updated!', 23, 0, CAST(N'2023-04-11T17:44:57.100' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (46, N'Warning project over budget!', 23, 0, CAST(N'2023-04-11T17:45:16.393' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (47, N'Total cost updated!', 46, 0, CAST(N'2023-04-11T17:45:41.423' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (48, N'Warning project over budget!', 23, 0, CAST(N'2023-04-11T17:56:45.530' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (49, N'Project Name Updated!', 23, 0, CAST(N'2023-04-11T17:56:45.530' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (50, N'Warning project over budget!', 23, 0, CAST(N'2023-04-11T17:56:57.740' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (51, N'Project Name Updated!', 23, 0, CAST(N'2023-04-11T17:56:57.740' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (52, N'Total cost updated!', 23, 0, CAST(N'2023-04-11T17:57:31.730' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (53, N'Total cost updated!', 999, 0, CAST(N'2023-04-11T18:04:04.090' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (54, N'Street Address Updated!', 999, 0, CAST(N'2023-04-11T18:04:04.090' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (55, N'Budget Updated!', 999, 0, CAST(N'2023-04-11T18:04:04.090' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (56, N'Project Name Updated!', 999, 0, CAST(N'2023-04-11T18:04:04.090' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (57, N'Zip Code Updated!', 999, 0, CAST(N'2023-04-11T18:04:04.090' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (58, N'City Updated!', 999, 0, CAST(N'2023-04-11T18:04:04.090' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (59, N'State Updated!', 999, 0, CAST(N'2023-04-11T18:04:04.090' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (60, N'Progress Updated!', 999, 0, CAST(N'2023-04-11T18:04:04.090' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (61, N'Department ID Updated!', 999, 0, CAST(N'2023-04-11T18:04:04.090' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (62, N'New project started!', 312, 0, CAST(N'2023-04-11T18:10:34.550' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (63, N'Total cost updated!', 312, 0, CAST(N'2023-04-11T18:10:59.100' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (64, N'Progress Updated!', 312, 0, CAST(N'2023-04-11T18:10:59.100' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (71, N'Total cost updated!', 312, 0, CAST(N'2023-04-12T00:37:54.787' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (72, N'Project completed!', 312, 0, CAST(N'2023-04-12T00:37:54.787' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (75, N'New project started!', 7842, 0, CAST(N'2023-04-12T00:57:29.397' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (76, N'Total cost updated!', 7842, 0, CAST(N'2023-04-12T00:59:48.650' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (77, N'Progress Updated!', 7842, 0, CAST(N'2023-04-12T00:59:48.650' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (79, N'Total cost updated!', 7842, 0, CAST(N'2023-04-12T01:09:01.133' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (80, N'Project completed!', 7842, 0, CAST(N'2023-04-12T01:09:01.133' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (83, N'New project started!', 356, 0, CAST(N'2023-04-12T02:10:56.160' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (84, N'Total cost updated!', 356, 0, CAST(N'2023-04-12T02:11:55.833' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (85, N'Progress Updated!', 356, 0, CAST(N'2023-04-12T02:11:55.833' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (86, N'Total cost updated!', 356, 0, CAST(N'2023-04-12T02:12:06.653' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (87, N'Project completed!', 356, 0, CAST(N'2023-04-12T02:12:06.653' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (88, N'Total cost updated!', 23, 0, CAST(N'2023-04-12T02:14:09.107' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (89, N'Project Name Updated!', 23, 0, CAST(N'2023-04-12T02:14:09.107' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (90, N'Total cost updated!', 23, 0, CAST(N'2023-04-12T02:14:55.590' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (91, N'Project Name Updated!', 23, 0, CAST(N'2023-04-12T02:14:55.590' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (92, N'Warning project over budget!', 23, 0, CAST(N'2023-04-12T02:15:19.110' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (93, N'Total cost updated!', 45, 0, CAST(N'2023-04-12T02:15:50.903' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (94, N'Progress Updated!', 45, 0, CAST(N'2023-04-12T02:15:50.903' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (95, N'Total cost updated!', 45, 0, CAST(N'2023-04-12T02:35:32.897' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (96, N'Progress Updated!', 45, 0, CAST(N'2023-04-12T02:35:32.897' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (97, N'Total cost updated!', 541, 0, CAST(N'2023-04-12T02:35:44.180' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (98, N'Progress Updated!', 541, 0, CAST(N'2023-04-12T02:35:44.180' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (99, N'Total cost updated!', 541, 0, CAST(N'2023-04-12T02:36:01.070' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (100, N'Progress Updated!', 541, 0, CAST(N'2023-04-12T02:36:01.070' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (101, N'Total cost updated!', 541, 0, CAST(N'2023-04-12T02:37:51.320' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (102, N'Progress Updated!', 541, 0, CAST(N'2023-04-12T02:37:51.320' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (103, N'Project completed!', 541, 0, CAST(N'2023-04-12T02:37:51.320' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (106, N'Total cost updated!', 254, 0, CAST(N'2023-04-12T02:42:44.913' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (107, N'Progress Updated!', 254, 0, CAST(N'2023-04-12T02:42:44.913' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (108, N'Total cost updated!', 254, 0, CAST(N'2023-04-12T02:43:21.420' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (109, N'Progress Updated!', 254, 0, CAST(N'2023-04-12T02:43:21.420' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (110, N'Total cost updated!', 254, 0, CAST(N'2023-04-12T02:44:09.667' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (111, N'Progress Updated!', 254, 0, CAST(N'2023-04-12T02:44:09.667' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (112, N'Total cost updated!', 254, 0, CAST(N'2023-04-12T02:46:09.600' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (113, N'Progress Updated!', 254, 0, CAST(N'2023-04-12T02:46:09.600' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (114, N'Total cost updated!', 45, 0, CAST(N'2023-04-12T02:46:24.070' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (115, N'Progress Updated!', 45, 0, CAST(N'2023-04-12T02:46:24.070' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (116, N'Total cost updated!', 254, 0, CAST(N'2023-04-12T02:46:39.763' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (117, N'Progress Updated!', 254, 0, CAST(N'2023-04-12T02:46:39.763' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (118, N'Total cost updated!', 333, 0, CAST(N'2023-04-12T02:47:05.350' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (119, N'Progress Updated!', 333, 0, CAST(N'2023-04-12T02:47:05.350' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (120, N'Total cost updated!', 432, 0, CAST(N'2023-04-12T02:49:37.070' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (121, N'Progress Updated!', 432, 0, CAST(N'2023-04-12T02:49:37.070' AS DateTime))
GO
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (122, N'Total cost updated!', 254, 0, CAST(N'2023-04-12T02:50:10.320' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (123, N'Progress Updated!', 254, 0, CAST(N'2023-04-12T02:50:10.320' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (124, N'Total cost updated!', 333, 0, CAST(N'2023-04-12T02:50:31.133' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (125, N'Progress Updated!', 333, 0, CAST(N'2023-04-12T02:50:31.133' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (126, N'Total cost updated!', 432, 0, CAST(N'2023-04-12T02:50:37.600' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (127, N'Progress Updated!', 432, 0, CAST(N'2023-04-12T02:50:37.600' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (128, N'Total cost updated!', 333, 0, CAST(N'2023-04-12T02:50:44.277' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (129, N'Progress Updated!', 333, 0, CAST(N'2023-04-12T02:50:44.277' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (130, N'Project completed!', 333, 0, CAST(N'2023-04-12T02:50:44.277' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (131, N'New project started!', 471, 0, CAST(N'2023-04-12T03:24:54.257' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (132, N'Total cost updated!', 254, 0, CAST(N'2023-04-12T03:25:33.603' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (133, N'Zip Code Updated!', 254, 0, CAST(N'2023-04-12T03:25:33.603' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (134, N'Total cost updated!', 254, 0, CAST(N'2023-04-12T03:25:42.117' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (135, N'Project completed!', 254, 0, CAST(N'2023-04-12T03:25:42.117' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (136, N'Warning project over budget!', 45, 0, CAST(N'2023-04-12T03:27:42.257' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (137, N'Warning project over budget!', 23, 0, CAST(N'2023-04-12T05:44:29.947' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (138, N'Street Address Updated!', 23, 0, CAST(N'2023-04-12T05:44:29.947' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (139, N'Total cost updated!', 999, 0, CAST(N'2023-04-12T06:47:28.587' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (140, N'Project completed!', 999, 0, CAST(N'2023-04-12T06:47:28.587' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (141, N'New project started!', 56, 0, CAST(N'2023-04-12T19:07:31.240' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (143, N'Total cost updated!', 1234, 0, CAST(N'2023-04-12T19:25:16.737' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (144, N'Progress Updated!', 1234, 0, CAST(N'2023-04-12T19:25:16.737' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (145, N'Project completed!', 1234, 0, CAST(N'2023-04-12T19:25:16.737' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (150, N'Total cost updated!', 471, 0, CAST(N'2023-04-12T19:38:06.700' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (151, N'Progress Updated!', 471, 0, CAST(N'2023-04-12T19:38:06.700' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (152, N'Project completed!', 471, 0, CAST(N'2023-04-12T19:38:06.700' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (153, N'Total cost updated!', 246, 0, CAST(N'2023-04-12T19:50:56.800' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (154, N'Progress Updated!', 246, 0, CAST(N'2023-04-12T19:50:56.800' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (155, N'New project started!', 8570, 0, CAST(N'2023-04-12T21:23:19.393' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (157, N'New project started!', 8571, 0, CAST(N'2023-04-12T21:40:52.680' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (158, N'Total cost updated!', 8571, 0, CAST(N'2023-04-12T21:41:31.910' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (159, N'Progress Updated!', 8571, 0, CAST(N'2023-04-12T21:41:31.910' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (160, N'Total cost updated!', 8571, 1, CAST(N'2023-04-12T21:41:45.287' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (161, N'Project completed!', 8571, 1, CAST(N'2023-04-12T21:41:45.287' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (162, N'Warning project over budget!', 32, 1, CAST(N'2023-04-12T21:44:27.017' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (163, N'Warning project over budget!', 32, 1, CAST(N'2023-04-12T21:44:55.000' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (164, N'Progress Updated!', 32, 1, CAST(N'2023-04-12T21:44:55.000' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (165, N'Project completed!', 32, 1, CAST(N'2023-04-12T21:44:55.000' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (166, N'Zip Code Updated!', 157, 1, CAST(N'2023-04-12T21:55:55.230' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (167, N'New project started!', 8572, 1, CAST(N'2023-04-12T22:07:13.040' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (168, N'Progress Updated!', 8572, 1, CAST(N'2023-04-12T22:07:46.617' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (169, N'Project completed!', 8572, 1, CAST(N'2023-04-12T22:07:57.473' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (170, N'Budget Updated!', 246, 1, CAST(N'2023-04-12T22:11:06.240' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (171, N'Warning project over budget!', 246, 1, CAST(N'2023-04-12T22:11:29.723' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (172, N'Warning project over budget!', 246, 1, CAST(N'2023-04-12T22:11:46.800' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (173, N'Progress Updated!', 246, 1, CAST(N'2023-04-12T22:11:46.800' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (174, N'Project completed!', 246, 1, CAST(N'2023-04-12T22:11:46.800' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (175, N'New project started!', 8573, 1, CAST(N'2023-04-12T22:37:24.137' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (176, N'Progress Updated!', 8573, 1, CAST(N'2023-04-12T22:37:59.640' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (177, N'Project completed!', 8573, 1, CAST(N'2023-04-12T22:38:14.840' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (178, N'Progress Updated!', 42, 1, CAST(N'2023-04-12T22:40:56.140' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (179, N'Warning project over budget!', 42, 1, CAST(N'2023-04-12T22:41:25.703' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (180, N'Warning project over budget!', 42, 1, CAST(N'2023-04-17T03:56:04.690' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (181, N'Zip Code Updated!', 42, 1, CAST(N'2023-04-17T03:56:04.690' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (182, N'Warning project over budget!', 42, 1, CAST(N'2023-04-17T03:56:55.767' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (183, N'Zip Code Updated!', 42, 1, CAST(N'2023-04-17T03:56:55.767' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (184, N'New project started!', 8574, 1, CAST(N'2023-04-22T20:19:48.070' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (185, N'Project completed!', 8572, 1, CAST(N'2023-04-22T22:04:57.087' AS DateTime))
INSERT [dbo].[Logs] ([LogID], [Message], [Project_ID], [isActive], [Date_Logged]) VALUES (186, N'Progress Updated!', 965, 1, CAST(N'2023-04-22T22:13:01.937' AS DateTime))
SET IDENTITY_INSERT [dbo].[Logs] OFF
GO
SET IDENTITY_INSERT [dbo].[Message] ON 

INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (1, N'You have been assigned a new task!', 22, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (13, N'You have been assigned a new task!', 22, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (14, N'You have been assigned a new task!', 35, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (15, N'You have been assigned a new task!', 35, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (18, N'You have been assigned a new task!', 35, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (19, N'Congratulations, you have recieved a salary increase!', 22, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (20, N'Due to lackluster performance you have recieved a salary cut', 22, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (21, N'Due to lackluster performance you have recieved a salary cut, Please discuss this with management for further details!', 22, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (22, N'You have been assigned a new task!', 82, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (23, N'You have been assigned a new task!', 22, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (24, N'You have been assigned a new task!', 22, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (25, N'Congratulations, you have recieved a salary increase!', 14, CAST(N'2023-04-12' AS Date), 0)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (26, N'Congratulations, you have recieved a salary increase!', 79, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (27, N'Due to lackluster performance you have recieved a salary cut, Please discuss this with management for further details!', 14, CAST(N'2023-04-12' AS Date), 0)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (28, N'Congratulations, you have recieved a salary increase!', 14, CAST(N'2023-04-12' AS Date), 0)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (29, N'Due to lackluster performance you have recieved a salary cut, Please discuss this with management for further details!', 14, CAST(N'2023-04-12' AS Date), 0)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (30, N'Congratulations, you have recieved a salary increase!', 22, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (31, N'You have been assigned a new task!', 22, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (32, N'You have been assigned a new task!', 79, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (33, N'You have been assigned a new task!', 101, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (34, N'You have been assigned a new task!', 103, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (35, N'You have been assigned a new task!', 202, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (36, N'You have been assigned a new task!', 204, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (37, N'You have been assigned a new task!', 204, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (38, N'You have been assigned a new task!', 206, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (39, N'You have been assigned a new task!', 208, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (40, N'You have been assigned a new task!', 210, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (41, N'You have been assigned a new task!', 143, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (42, N'You have been assigned a new task!', 165, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (43, N'You have been assigned a new task!', 189, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (44, N'You have been assigned a new task!', 327, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (45, N'You have been assigned a new task!', 111, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (46, N'Congratulations, you have recieved a salary increase!', 35, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (47, N'You have been assigned a new task!', 77, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (48, N'You have been assigned a new task!', 210, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (49, N'You have been assigned a new task!', 103, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (50, N'Congratulations, you have recieved a salary increase!', 22, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (51, N'You have been assigned a new task!', 77, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (52, N'You have been assigned a new task!', 82, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (53, N'You have been assigned a new task!', 101, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (54, N'You have been assigned a new task!', 202, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (55, N'You have been assigned a new task!', 79, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (56, N'You have been assigned a new task!', 67, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (57, N'You have been assigned a new task!', 22, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (58, N'Congratulations, you have recieved a salary increase!', 329, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (59, N'You have been assigned a new task!', 329, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (60, N'You have been assigned a new task!', 329, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (61, N'Congratulations, you have recieved a salary increase!', 329, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (62, N'You have been assigned a new task!', 329, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (63, N'Due to lackluster performance you have recieved a salary cut, please discuss this with management for further details!', 329, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (64, N'Congratulations, you have recieved a salary increase!', 330, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (65, N'You have been assigned a new task!', 330, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (66, N'You have been assigned a new task!', 330, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (67, N'Due to lackluster performance you have recieved a salary cut, please discuss this with management for further details!', 330, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (68, N'Congratulations, you have recieved a salary increase!', 331, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (69, N'You have been assigned a new task!', 331, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (70, N'You have been assigned a new task!', 331, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (71, N'Due to lackluster performance you have recieved a salary cut, please discuss this with management for further details!', 331, CAST(N'2023-04-12' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (72, N'You have been assigned a new task!', 22, CAST(N'2023-04-22' AS Date), 1)
INSERT [dbo].[Message] ([MessageID], [Message], [RecipientID], [Date_Sent], [isActive]) VALUES (73, N'You have been assigned a new task!', 22, CAST(N'2023-04-22' AS Date), 1)
SET IDENTITY_INSERT [dbo].[Message] OFF
GO
SET IDENTITY_INSERT [dbo].[Project] ON 

INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (34, 21, N'Project C', 5000, N'321 Road', N'Houston', N'Texas', 1516616161, 8, 10000, 0, NULL, NULL, NULL)
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (10, 23, N'Customer Research', 100000, N'457 Oak St', N'Chicago', N'IL', 60601, 6, 80000, 1, CAST(N'2023-01-01' AS Date), NULL, CAST(N'2023-07-31' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (100, 32, N'Expansion Project', 35000, N'789 Oak Ave', N'Denver', N'CO', 80202, 8, 30000, 0, CAST(N'2023-04-01' AS Date), NULL, CAST(N'2024-04-01' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (50, 42, N'Marketing Campaign', 60000, N'333 Broadway', N'New York', N'NY', 55695, 8, 50000, 1, CAST(N'2023-02-01' AS Date), NULL, CAST(N'2024-07-01' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (80, 45, N'Sales Enablement', 130000, N'234 Main St', N'Miami', N'FL', 33101, 8, 120000, 1, CAST(N'2023-03-01' AS Date), NULL, CAST(N'2023-09-30' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (20, 46, N'Content Creation', 30000, N'678 Elm St', N'Washington', N'DC', 20001, 8, 50000, 1, CAST(N'2023-04-15' AS Date), NULL, CAST(N'2023-10-31' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (50, 56, N'Project X', 5000, N'123 Main St', N'Los Angeles', N'CA', 90001, 8, 1000000, 1, CAST(N'2023-01-01' AS Date), NULL, CAST(N'2024-01-01' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (70, 67, N'Digital Marketing', 180000, N'456 Elm St', N'San Francisco', N'CA', 94101, 8, 200000, 1, CAST(N'2023-05-01' AS Date), NULL, CAST(N'2023-11-30' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (20, 75, N'Research Study', 15000, N'555 5th St', N'Portland', N'OR', 97201, 8, 20000, 1, CAST(N'2023-10-01' AS Date), NULL, CAST(N'2024-09-01' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (90, 79, N'Lead Generation', 225000, N'345 Cedar Ave', N'Seattle', N'WA', 98101, 6, 250000, 1, CAST(N'2023-06-01' AS Date), NULL, CAST(N'2024-01-31' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (60, 81, N'Event Planning', 90000, N'789 Oak St', N'Austin', N'TX', 78701, 8, 120000, 1, CAST(N'2023-07-01' AS Date), NULL, CAST(N'2023-12-31' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (30, 97, N'Product Launch', 75000, N'123 Main St', N'New York', N'NY', 10001, 8, 100000, 1, CAST(N'2023-02-15' AS Date), NULL, CAST(N'2023-08-31' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (50, 123, N'Project B', 25000, N'123 Jump Street', N'Houston', N'MA', 77777, 8, 20000, 0, NULL, NULL, NULL)
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (97, 157, N'Project Phoenix', 90000, N'222 2nd St', N'Chicago', N'IL', 60602, 8, 100000, 1, CAST(N'2023-07-01' AS Date), NULL, CAST(N'2024-06-01' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (90, 234, N'Content Creation', 20000, N'678 Elm St', N'Seattle', N'WA', 98101, 8, 25000, 1, CAST(N'2023-06-01' AS Date), NULL, CAST(N'2023-11-01' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (100, 246, N'Software Development', 700000, N'123 Cedar St', N'San Francisco', N'CA', 94101, 8, 600000, 0, CAST(N'2022-02-01' AS Date), NULL, CAST(N'2022-08-31' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (45, 254, N'Project J', 50000, N'765 North Road', N'Miami', N'FL', 48521, 8, 70000, 0, CAST(N'2023-04-10' AS Date), NULL, CAST(N'2023-04-22' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (10, 268, N'Green Initiative', 1000, N'111 Pine St', N'San Francisco', N'CA', 94111, 8, 5000, 1, CAST(N'2023-06-05' AS Date), NULL, CAST(N'2024-05-01' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (100, 312, N'example', 20000, N'123 123', N'city', N'state', 11111, 6, 20001, 0, CAST(N'2023-04-11' AS Date), NULL, CAST(N'2023-04-11' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (71, 314, N'Construction Project', 70000, N'777 7th St', N'Houston', N'TX', 77002, 8, 80000, 1, CAST(N'2023-12-01' AS Date), NULL, CAST(N'2024-11-01' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (75, 318, N'Project L', 10000, N'214 Evandale Lane', N'Phoenix', N'AZ', 54634, 8, 15000, 0, NULL, NULL, NULL)
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (100, 333, N'Project O', 15000, N'123 Road Rd', N'Dallas', N'TX', 77414, 8, 60000, 0, NULL, NULL, NULL)
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (25, 345, N'Marketing Research', 50000, N'456 Pine Ave', N'Dallas', N'TX', 75201, 8, 100000, 1, CAST(N'2023-07-01' AS Date), NULL, CAST(N'2024-01-01' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (50, 356, N'Project B', 12000, N'456 West Road', N'Houston', N'TX', 77521, 6, 20000, 0, CAST(N'2023-04-10' AS Date), NULL, CAST(N'2024-03-12' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (20, 369, N'Content Creation', 20000, N'456 Pine St', N'Seattle', N'WA', 98101, 8, 30000, 1, CAST(N'2022-05-15' AS Date), NULL, CAST(N'2022-10-31' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (27, 432, N'Website Redesign', 80000, N'456 Elm St', N'Chicago', N'IL', 60601, 8, 120000, 1, CAST(N'2022-03-15' AS Date), NULL, CAST(N'2022-09-30' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (52, 451, N'Project G', 20000, N'321 Road', N'Houston', N'TX', 45613, 8, 30000, 0, NULL, NULL, NULL)
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (74, 452, N'Project Q', 5000, N'123 Road', N'Houston', N'TX', 64231, 8, 10000, NULL, NULL, NULL, NULL)
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (50, 456, N'Website Redesign', 75000, N'123 Main St', N'Chicago', N'IL', 60601, 8, 100000, 1, CAST(N'2023-03-15' AS Date), NULL, CAST(N'2023-08-15' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (100, 471, N'Project C', 10000, N'123 Road', N'Houston', N'TX', 48521, 6, 25000, 0, CAST(N'2023-04-10' AS Date), NULL, CAST(N'2024-03-12' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (25, 532, N'Language Model', 20000, N'721 New Field Drive', N'Houston', N'TX', 45123, 8, 50000, 0, NULL, NULL, NULL)
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (100, 541, N'Project Z', 15500, N'456 West Road', N'Sugar Land', N'TX', 45123, 8, 40000, 0, CAST(N'2023-04-10' AS Date), NULL, CAST(N'2023-04-30' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (0, 546, N'yhd', 5346, N'456 West Road', N'awf', N'sadf', 32555, 8, 5435346, 0, CAST(N'2023-04-10' AS Date), NULL, CAST(N'2023-04-30' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (75, 567, N'Product Launch', 250000, N'789 Maple Ave', N'New York', N'NY', 10001, 8, 500000, 1, CAST(N'2022-05-01' AS Date), NULL, CAST(N'2022-11-30' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (65, 645, N'Project G', 40000, N'123 Valley Road', N'Austin', N'TX', 87643, 8, 85000, 0, NULL, NULL, NULL)
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (25, 651, N'Project G', 100, N'123 Road', N'Houston', N'TX', 45123, 8, 5000, 0, NULL, NULL, NULL)
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (63, 654, N'Project C', 10000, N'812 Tahoe Valley', N'Houston', N'Texas', 64234, 8, 3000, 0, NULL, NULL, NULL)
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (20, 678, N'Email Marketing', 30000, N'789 Elm St', N'Austin', N'TX', 78701, 8, 50000, 1, CAST(N'2023-01-01' AS Date), NULL, CAST(N'2023-06-30' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (40, 741, N'Market Research', 40000, N'987 Oak Ave', N'Boston', N'MA', 2101, 8, 60000, 1, CAST(N'2022-07-01' AS Date), NULL, CAST(N'2022-12-31' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (42, 747, N'Project L', 20000, N'721 New Field Drive', N'Houston', N'TX', 64315, 8, 10000, 0, NULL, NULL, NULL)
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (30, 789, N'Social Media Strategy', 90000, N'345 Oak St', N'Los Angeles', N'CA', 90001, 8, 150000, 1, CAST(N'2022-04-01' AS Date), NULL, CAST(N'2022-09-30' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (63, 845, N'Project I', 5000, N'214 Evandale Lane', N'Houston', N'TX', 45685, 8, 4000, 0, NULL, NULL, NULL)
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (90, 852, N'Brand Identity', 120000, N'789 Spruce St', N'Denver', N'CO', 80201, 8, 150000, 1, CAST(N'2022-03-01' AS Date), NULL, CAST(N'2022-09-30' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (75, 876, N'New Development', 7500, N'456 Elm St', N'Seattle', N'WA', 98101, 8, 900000, 1, CAST(N'2023-02-01' AS Date), NULL, CAST(N'2024-02-01' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (20, 891, N'Email Marketing', 30000, N'789 Elm St', N'Austin', N'TX', 78701, 8, 50000, 1, CAST(N'2023-01-01' AS Date), NULL, CAST(N'2023-06-30' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (82, 953, N'Product Launch', 8000, N'444 4th St', N'Austin', N'TX', 78701, 8, 100000, 1, CAST(N'2023-07-01' AS Date), NULL, CAST(N'2024-08-01' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (40, 965, N'Expansion Project', 2500, N'666 6th St', N'Boston', N'MA', 2108, 8, 40000, 1, CAST(N'2023-11-01' AS Date), NULL, CAST(N'2024-10-01' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (50, 987, N'Event Planning', 75000, N'654 Cherry St', N'Houston', N'TX', 77001, 8, 100000, 1, CAST(N'2022-06-15' AS Date), NULL, CAST(N'2022-12-31' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (0, 999, N'Department Building Construction', 30000, N'9821 Baker St', N'Houston', N'Texas', 77001, 6, 100000, 0, CAST(N'2023-04-11' AS Date), NULL, CAST(N'2024-04-11' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (12, 1234, N'Marketing Campaign', 500000, N'123 Main St', N'Austin', N'TX', 78701, 8, 1000000, 0, CAST(N'2022-01-01' AS Date), NULL, CAST(N'2022-06-30' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (41, 1541, N'Project A', 25000, N'642 Kinghts Branch', N'Houston', N'TX', 45123, 8, 75000, 0, NULL, NULL, NULL)
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (0, 2232, N'Super Cool Project', 7000, N'Generic Street Address 123', N'City', N'State', 12345, 8, 10000, 0, NULL, NULL, NULL)
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (23, 5463, N'Project R', 100, N'123 Valley', N'Houston', N'TX', 54634, 8, 5000, 0, NULL, NULL, NULL)
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (10, 5557, N'Project O', 1235, N'3722 CYPRESS KEY DR', N'Spring', N'TX', 77388, 8, 99999, 0, NULL, NULL, NULL)
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (40, 7842, N'Project M', 1000, N'123 Road', N'Houston', N'TX', 54613, 6, 3000, 0, CAST(N'2023-06-19' AS Date), NULL, CAST(N'2024-03-12' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (85, 8569, N'Project C', 65000, N'432 Tahoe Valley', N'Los Angeles', N'CA', 12485, 8, 80000, 0, NULL, NULL, NULL)
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (0, 8570, N'Project Secret', 500, N'123 jump street', N'Katy', N'Tx', 77494, 8, 10000, 1, CAST(N'2023-04-11' AS Date), NULL, CAST(N'2023-05-15' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (75, 8571, N'Project Z', 10000, N'123 Road', N'Houston', N'TX', 55667, 8, 20000, 0, CAST(N'2023-05-15' AS Date), NULL, CAST(N'2023-08-15' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (30, 8572, N'Project Z', 10000, N'123 Road', N'Houston', N'TX', 45364, 8, 20000, 0, CAST(N'2023-04-15' AS Date), NULL, CAST(N'2024-04-11' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (75, 8573, N'Project A', 10000, N'123 Road', N'Houston', N'TX', 77777, 8, 20000, 0, CAST(N'2023-04-15' AS Date), NULL, CAST(N'2023-08-01' AS Date))
INSERT [dbo].[Project] ([Progress], [ID], [Name], [Total_Cost], [Street_Address], [City], [State], [Zip_Code], [Department_ID], [Budget], [isActive], [Start_Date], [End_Date], [Deadline]) VALUES (10, 8574, N'Sales Research', 12000, N'456 West Road', N'Houston', N'TX', 45412, 8, 15000, 1, CAST(N'2023-04-10' AS Date), NULL, CAST(N'2024-03-12' AS Date))
SET IDENTITY_INSERT [dbo].[Project] OFF
GO
SET IDENTITY_INSERT [dbo].[WORKS_ON] ON 

INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'SORTING', CAST(N'2023-03-01' AS Date), NULL, NULL, 25, 318, N'do some sorting', NULL, CAST(N'2023-03-27' AS Date), 2)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'SORTING', CAST(N'2023-03-01' AS Date), CAST(N'2023-04-04' AS Date), 3, 22, 318, N'do some sorting', 100, CAST(N'2023-03-27' AS Date), 3)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'SORTING', CAST(N'2023-03-01' AS Date), CAST(N'2023-04-22' AS Date), 6, 22, 318, N'do some sorting', 100, CAST(N'2023-03-27' AS Date), 4)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'DO SOMETHING', CAST(N'2023-03-29' AS Date), CAST(N'2023-04-04' AS Date), 3, 22, 645, N'do something', 52, CAST(N'2023-04-05' AS Date), 5)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'DO SOMETHING', CAST(N'2023-03-01' AS Date), NULL, NULL, 14, 645, N'do something', NULL, CAST(N'2023-04-05' AS Date), 6)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'SORTING', CAST(N'2023-03-01' AS Date), NULL, NULL, 34, 318, N'do some sorting', 91, CAST(N'2023-04-05' AS Date), 7)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'Fix Update', CAST(N'2023-03-27' AS Date), NULL, 0, 14, 123, N'Fix project update', 0, CAST(N'2023-04-26' AS Date), 8)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'TASK', CAST(N'2023-04-01' AS Date), NULL, 1, 22, 21, N'Do a task', 5, CAST(N'2023-04-10' AS Date), 9)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'SOMETHING LONG', CAST(N'2023-04-03' AS Date), NULL, 0, 22, 123, N'Doing a thing while doing another thing also asdfasdfasdfasdfasf', 0, CAST(N'2023-04-21' AS Date), 10)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'ORDER NEW ITEM', CAST(N'2023-04-04' AS Date), CAST(N'2023-04-12' AS Date), 5, 22, 21, N'new purchase', 100, CAST(N'2023-04-20' AS Date), 11)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'MERGING', CAST(N'2023-04-08' AS Date), NULL, NULL, 14, 318, N'Join branches', NULL, CAST(N'2023-04-22' AS Date), 12)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'SOMETHING TO DO', CAST(N'2023-04-11' AS Date), NULL, NULL, 81, 23, N'Something normal', NULL, CAST(N'2023-04-12' AS Date), 13)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'DO SOMETHING', CAST(N'2023-04-11' AS Date), NULL, NULL, 81, 23, N'do something', NULL, CAST(N'2023-04-11' AS Date), 14)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'DOING SOMETHING', CAST(N'2023-04-11' AS Date), NULL, NULL, 81, 23, N'doing something ', NULL, CAST(N'2023-04-12' AS Date), 15)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'TASK', CAST(N'2023-04-01' AS Date), NULL, 2, 81, 23, N'Do a task', 50, CAST(N'2023-04-10' AS Date), 16)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'ANYTHING', CAST(N'2023-04-08' AS Date), NULL, NULL, 81, 999, N'do anything', NULL, CAST(N'2023-04-13' AS Date), 17)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'DOING SOMETHINGS', CAST(N'2023-04-11' AS Date), NULL, NULL, 81, 23, N'doing somethings', NULL, CAST(N'2023-05-11' AS Date), 18)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'TASK', CAST(N'2023-04-01' AS Date), CAST(N'2023-04-11' AS Date), 5, 81, 23, N'Do a task', 100, CAST(N'2023-04-10' AS Date), 19)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'DO SOMETHIN', CAST(N'2023-04-08' AS Date), NULL, NULL, 81, 999, N'doing somethin', NULL, CAST(N'2023-04-12' AS Date), 20)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'APPLE', CAST(N'1900-01-01' AS Date), NULL, NULL, 35, 23, N'Jam', NULL, CAST(N'2023-05-10' AS Date), 21)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'FGSDFGS', CAST(N'2023-04-12' AS Date), CAST(N'2023-04-22' AS Date), 8, 22, 23, N'do something', 100, CAST(N'2023-05-11' AS Date), 22)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'TASK', CAST(N'2000-01-01' AS Date), NULL, 0, 22, 23, NULL, 0, CAST(N'2000-01-01' AS Date), 23)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'FGSDFG123S', CAST(N'2023-04-12' AS Date), NULL, 0, 22, 23, N'doing something qwe', 0, CAST(N'2023-05-11' AS Date), 24)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'BANANA', CAST(N'2023-04-12' AS Date), NULL, 0, 35, 23, N'''Smoothie''', 0, CAST(N'2023-05-10' AS Date), 25)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'SOMETHING TO DO', CAST(N'2023-04-12' AS Date), NULL, 0, 35, 23, N'''Something normal''', 0, CAST(N'2023-08-10' AS Date), 26)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'BANANA', CAST(N'2023-04-12' AS Date), NULL, 0, 35, 23, N'''Jam''', 0, CAST(N'2023-04-12' AS Date), 27)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'SOMETHING', CAST(N'2023-04-12' AS Date), NULL, 0, 82, 23, N'''Something''', 0, CAST(N'2023-04-15' AS Date), 28)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'DOING SOMETHING', CAST(N'2023-04-12' AS Date), NULL, 0, 22, 23, N'something', 0, CAST(N'2023-05-15' AS Date), 29)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'TASK', CAST(N'2023-04-12' AS Date), CAST(N'2023-04-22' AS Date), 5, 22, 23, N'null', 100, CAST(N'2000-01-01' AS Date), 30)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'DATABASE DEPLOYMENT', CAST(N'2023-04-12' AS Date), CAST(N'2023-04-22' AS Date), 5, 22, 23, N'''Setting up database''', 100, CAST(N'2023-05-11' AS Date), 31)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'TASK', CAST(N'2023-04-12' AS Date), NULL, 0, 79, 23, N'null', 0, CAST(N'2030-01-01' AS Date), 32)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'WORKIN', CAST(N'2023-04-12' AS Date), NULL, 0, 101, 432, N'''Do the work''', 0, CAST(N'2023-04-29' AS Date), 33)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'WORKIN', CAST(N'2023-04-12' AS Date), NULL, 0, 103, 678, N'''Do the work''', 0, CAST(N'2023-04-21' AS Date), 34)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'FAXING', CAST(N'2023-04-12' AS Date), NULL, 0, 202, 97, N'''Do the fax''', 0, CAST(N'2023-04-30' AS Date), 35)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'FAXING', CAST(N'2023-04-12' AS Date), NULL, 0, 204, 741, N'''Do the fax''', 0, CAST(N'2023-04-22' AS Date), 36)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'FAXING', CAST(N'2023-04-12' AS Date), NULL, 0, 204, 81, N'''Do the fax''', 0, CAST(N'2023-04-15' AS Date), 37)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'EMAIL', CAST(N'2023-04-12' AS Date), NULL, 0, 206, 432, N'''Send the email''', 0, CAST(N'2023-04-28' AS Date), 38)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'EMAIL', CAST(N'2023-04-12' AS Date), NULL, 0, 208, 987, N'''Send the email''', 0, CAST(N'2023-05-01' AS Date), 39)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'EMAIL', CAST(N'2023-04-12' AS Date), NULL, 0, 210, 891, N'''Send the email''', 0, CAST(N'2023-04-29' AS Date), 40)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'MEMO', CAST(N'2023-04-12' AS Date), NULL, 0, 143, 567, N'''Receive the memo''', 0, CAST(N'2023-04-19' AS Date), 41)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'MEMO', CAST(N'2023-04-12' AS Date), NULL, 0, 165, 456, N'''Receive the memo''', 0, CAST(N'2023-04-30' AS Date), 42)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'MEMO', CAST(N'2023-04-12' AS Date), NULL, 0, 189, 345, N'''Receive the memo''', 0, CAST(N'2023-05-02' AS Date), 43)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'MEMO', CAST(N'2023-04-12' AS Date), NULL, 0, 327, 345, N'''Receive the memo''', 0, CAST(N'2023-05-04' AS Date), 44)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'MEETING', CAST(N'2023-04-12' AS Date), NULL, 0, 111, 471, N'''Prepare meetings''', 0, CAST(N'2023-04-19' AS Date), 45)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'TASK', CAST(N'2023-04-12' AS Date), NULL, 0, 77, 23, N'null', 0, CAST(N'2000-01-01' AS Date), 46)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'TASK', CAST(N'2023-04-12' AS Date), NULL, 0, 210, 23, N'''Do a task''', 0, CAST(N'2023-04-10' AS Date), 47)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'TASK', CAST(N'2023-04-12' AS Date), NULL, 0, 103, 23, N'''Do a task''', 0, CAST(N'2000-01-01' AS Date), 48)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'DO SOMETHIN', CAST(N'2023-04-12' AS Date), NULL, 0, 77, 56, N'''Send the email''', 0, CAST(N'2023-04-30' AS Date), 49)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'DO SOMETHIN', CAST(N'2023-04-12' AS Date), NULL, 0, 82, 876, N'''Send the email''', 0, CAST(N'2023-04-19' AS Date), 50)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'DO SOMETHIN', CAST(N'2023-04-12' AS Date), NULL, 0, 101, 32, N'''Send the email''', 0, CAST(N'2023-04-22' AS Date), 51)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'DO SOMETHIN', CAST(N'2023-04-12' AS Date), NULL, 0, 202, 157, N'''Send the email''', 0, CAST(N'2023-04-30' AS Date), 52)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'DO SOMETHIN', CAST(N'2023-04-12' AS Date), NULL, 0, 79, 953, N'''Send the email''', 0, CAST(N'2023-04-30' AS Date), 53)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'MEETING', CAST(N'2023-04-12' AS Date), NULL, 0, 67, 75, N'''Send the email''', 0, CAST(N'2023-05-03' AS Date), 54)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'CREATE PRESENTATION', CAST(N'2023-04-12' AS Date), NULL, 0, 22, 23, N'''Create powerpoint presentation''', 0, CAST(N'2023-05-15' AS Date), 55)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'DOING SOMETHING', CAST(N'2023-04-12' AS Date), CAST(N'2023-04-12' AS Date), 5, 329, 23, N'''Something quick''', 100, CAST(N'2023-04-15' AS Date), 56)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'LATE JOB', CAST(N'2023-04-12' AS Date), NULL, 2, 329, 23, N'''Some Late''', 50, CAST(N'2023-01-01' AS Date), 57)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'DATABASE DEPLOYMENT', CAST(N'2023-04-12' AS Date), NULL, 0, 329, 23, N'''deploy a database''', 0, CAST(N'2023-05-11' AS Date), 58)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'RESEARCH', CAST(N'2023-04-12' AS Date), NULL, 4, 330, 23, N'''Research Customers''', 100, CAST(N'2023-04-15' AS Date), 59)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'RESEARCH SOONER', CAST(N'2023-04-12' AS Date), CAST(N'2023-04-12' AS Date), 10, 330, 23, N'''Research Customers''', 200, CAST(N'2023-01-01' AS Date), 60)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'TRAINING', CAST(N'2023-04-12' AS Date), CAST(N'2023-04-12' AS Date), 4, 331, 23, N'''Train Employee''', 200, CAST(N'2023-04-01' AS Date), 61)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'RESEARCH', CAST(N'2023-04-12' AS Date), NULL, 2, 331, 23, N'''Customer Research''', 100, CAST(N'2023-04-20' AS Date), 62)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'DECREASE PROJECT TITLE', CAST(N'2023-04-22' AS Date), NULL, 0, 22, 56, N'''Rename &quot;Project X&quot; to &quot;Project IX&quot;''', 0, CAST(N'2023-05-10' AS Date), 63)
INSERT [dbo].[WORKS_ON] ([Job_Title], [Start_Date], [End_Date], [Total_Hours], [Employee_ID], [Project_ID], [Description], [Progress], [Deadline], [ID]) VALUES (N'TASK', CAST(N'2023-04-23' AS Date), NULL, 0, 22, 21, N'''Do the task''', 0, CAST(N'2023-04-29' AS Date), 64)
SET IDENTITY_INSERT [dbo].[WORKS_ON] OFF
GO
ALTER TABLE [dbo].[Department]  WITH CHECK ADD  CONSTRAINT [FK_Department_Manager] FOREIGN KEY([Manager_ID])
REFERENCES [dbo].[Employee] ([ID])
GO
ALTER TABLE [dbo].[Department] CHECK CONSTRAINT [FK_Department_Manager]
GO
ALTER TABLE [dbo].[Dept_Locations]  WITH CHECK ADD  CONSTRAINT [FK_Dept_Locations_Department] FOREIGN KEY([Department_ID])
REFERENCES [dbo].[Department] ([ID])
GO
ALTER TABLE [dbo].[Dept_Locations] CHECK CONSTRAINT [FK_Dept_Locations_Department]
GO
ALTER TABLE [dbo].[Employee]  WITH CHECK ADD  CONSTRAINT [FK_Employee_Department] FOREIGN KEY([Department_ID])
REFERENCES [dbo].[Department] ([ID])
GO
ALTER TABLE [dbo].[Employee] CHECK CONSTRAINT [FK_Employee_Department]
GO
ALTER TABLE [dbo].[Project]  WITH CHECK ADD  CONSTRAINT [FK_Proj_Department] FOREIGN KEY([Department_ID])
REFERENCES [dbo].[Department] ([ID])
GO
ALTER TABLE [dbo].[Project] CHECK CONSTRAINT [FK_Proj_Department]
GO
ALTER TABLE [dbo].[Transactions]  WITH CHECK ADD  CONSTRAINT [FK_Dept_Transaction] FOREIGN KEY([Department_ID])
REFERENCES [dbo].[Department] ([ID])
GO
ALTER TABLE [dbo].[Transactions] CHECK CONSTRAINT [FK_Dept_Transaction]
GO
ALTER TABLE [dbo].[Transactions]  WITH CHECK ADD  CONSTRAINT [FK_Proj_Transaction] FOREIGN KEY([Project_ID])
REFERENCES [dbo].[Project] ([ID])
GO
ALTER TABLE [dbo].[Transactions] CHECK CONSTRAINT [FK_Proj_Transaction]
GO
ALTER TABLE [dbo].[Transactions]  WITH CHECK ADD  CONSTRAINT [FK_Transactions_Proj] FOREIGN KEY([Project_ID])
REFERENCES [dbo].[Project] ([ID])
GO
ALTER TABLE [dbo].[Transactions] CHECK CONSTRAINT [FK_Transactions_Proj]
GO
ALTER TABLE [dbo].[WORKS_ON]  WITH CHECK ADD  CONSTRAINT [FK_WORKS_ON_Employee] FOREIGN KEY([Employee_ID])
REFERENCES [dbo].[Employee] ([ID])
GO
ALTER TABLE [dbo].[WORKS_ON] CHECK CONSTRAINT [FK_WORKS_ON_Employee]
GO
ALTER TABLE [dbo].[WORKS_ON]  WITH CHECK ADD  CONSTRAINT [FK_WORKS_ON_Proj] FOREIGN KEY([Project_ID])
REFERENCES [dbo].[Project] ([ID])
GO
ALTER TABLE [dbo].[WORKS_ON] CHECK CONSTRAINT [FK_WORKS_ON_Proj]
GO
ALTER DATABASE [UMADATABASE_TEAM6] SET  READ_WRITE 
GO
